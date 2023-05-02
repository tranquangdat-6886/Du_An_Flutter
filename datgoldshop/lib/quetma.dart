import 'dart:convert';
import 'package:excel/excel.dart';
import 'package:flutter/material.dart';
// sử dụng để hiển thị mã vạch
import 'package:barcode_scan2/barcode_scan2.dart'; //sử dụng để quét mã vạch 1d và 2d
import 'package:http/http.dart' as http;
import 'package:open_file/open_file.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'dart:io';

// import 'package:path_provider/path_provider.dart';

import 'package:downloads_path_provider_28/downloads_path_provider_28.dart';
import 'package:fluttertoast/fluttertoast.dart';

class QuetMa extends StatefulWidget {
  final dynamic data;
  final int index;
  const QuetMa(this.data, this.index, {super.key});

  @override
  _MyAppState createState() => _MyAppState();
  get getData => data;
}

class _MyAppState extends State<QuetMa> {
  String barcode = "";
  String infoText = "";
  int liststudents = 0; //đếm có bao nhiêu sinh viên tham gia sự kiện
  bool isEventsEmpty =
      true; //để kiểm tra nêú events có dữ liệu thì in ra nút button
  bool isLoading = false;
  //bắt đầu thực hiện liststudents

  @override
  void initState() {
    super.initState();
    getListStudents().then((value) {
      setState(() {
        liststudents = value ?? 0;
      });
    });
  }

// Lấy danh sách sự kiện từ API
  Future<List<Map<String, dynamic>>> fetchEventsFromAPI() async {
    final response = await http.get(
        Uri.parse('https://644f5b52b61a9f0c4d20f978.mockapi.io/liststudents'));
    if (response.statusCode == 200) {
      final String utf8String = utf8.decode(response.bodyBytes);
      final List<dynamic> eventsJson = json.decode(utf8String);
      List<Map<String, dynamic>> events = [];
      for (var eventJson in eventsJson) {
        if (eventJson['EVE_ID'] == widget.data['eventName']) {
          events.add({
            'id': eventJson['id'],
            'msv': eventJson['STU_ID'],
            'lastname': eventJson['LastName'],
            'firstname': eventJson['FirstName'],
            'events': eventJson['EVE_ID'],
            'eventdate': eventJson['CreateDate'],
          });
        }
      }
      return events;
    } else {
      throw Exception('Failed to fetch events');
    }
  }

  Future<int?> getListStudents() async {
    final response = await http.get(
        Uri.parse('https://644f5b52b61a9f0c4d20f978.mockapi.io/liststudents'));
    if (response.statusCode == 200) {
      //dữ liệu trả về 200 có nghĩa trong API liststudents có dữ liệu
      //thêm điều kiện có dữ liệu với thuộc tính sau

      final responseBody =
          jsonDecode(utf8.decode(response.bodyBytes)) as List<dynamic>;
      List<dynamic> filteredList = [];
      for (final jsonBody in responseBody) {
        if (jsonBody['EVE_ID'] == widget.data['eventName']) {
          filteredList.add(jsonBody);
          isEventsEmpty =
              false; //có dữ liệu thì sét isEventsEmplty = false để hiển thị nút xuất danh sách
        }
      }
      return filteredList.length;
    } else {
      return null;
    }
  }

  void saveListStudents(int liststudents) async {
    final prefs = await SharedPreferences.getInstance();
    prefs.setInt('liststudents', liststudents);
  }

  //kết thúc phần đếm ở dưới chỉ cần in ra thôi

  //bắt đầu việc xuất file ra excel
  bool isExportSuccess = false;

  Future<void> exportDataToExcel(List<Map<String, dynamic>> data) async {
    Fluttertoast.showToast(
        msg: "Đang xuất file...",
        toastLength: Toast.LENGTH_LONG,
        gravity: ToastGravity.BOTTOM,
        backgroundColor: Colors.grey[600],
        textColor: Colors.white,
        fontSize: 16.0);

    // Tạo workbook (file Excel)
    var workbook = Excel.createExcel();

    // Tạo sheet và đặt tên là "Sheet1"
    var sheet = workbook['Sheet1'];

    // Đặt tiêu đề cho các cột
    sheet.appendRow(
        ['STT', 'MSSV', 'Họ', 'Tên', 'Tham Gia Sự Kiện' 'CreateDate']);

    // Ghi dữ liệu vào sheet
    for (var item in data) {
      sheet.appendRow([
        item['id'],
        item['msv'],
        item['lastname'],
        item['firstname'],
        item['events'],
        item['eventdate'],
      ]);
    }

    // Lưu workbook vào file Excel
    var directory = await DownloadsPathProvider.downloadsDirectory;
    var filePath = '${directory!.path}/danh-sách-điểm-danh-sinh-viên.xlsx';
    var datgold = File(filePath);

    // Kiểm tra quyền truy cập bộ nhớ và lưu tệp Excel
    try {
      await datgold.writeAsBytes(workbook.encode()!);
      // Hiển thị thông báo toast khi xuất file thành công
      Fluttertoast.showToast(
          msg: "Xuất file thành công",
          toastLength: Toast.LENGTH_LONG,
          gravity: ToastGravity.BOTTOM,
          backgroundColor: Colors.green[600],
          textColor: Colors.white,
          fontSize: 16.0);
      isExportSuccess = true;
    } catch (e) {
      print('Lỗi khi lưu file Excel: $e');
    }

    if (isExportSuccess) {
      // Hiển thị nút "Open"
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Xuất file thành công'),
            content: const Text('Bạn có muốn mở file không?'),
            actions: <Widget>[
              TextButton(
                child: const Text('Cancel'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
              TextButton(
                child: const Text('Open'),
                onPressed: () {
                  // Mở file Excel
                  OpenFile.open(filePath);
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
    }
  }

  void exportToExcel() async {
    setState(() {
      isLoading = true;
    });

    try {
      List<Map<String, dynamic>> events = await fetchEventsFromAPI();
      await exportDataToExcel(events);
    } catch (e) {
      print(e);
      showDialog(
        context: context,
        builder: (context) {
          return AlertDialog(
            title: const Text('Lỗi'),
            content:
                const Text('Không thể xuất danh sách sự kiện ra file Excel'),
            actions: [
              TextButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                child: const Text('OK'),
              )
            ],
          );
        },
      );
    } finally {
      setState(() {
        isLoading = false;
      });
    }
  }

//kết thúc phần xuất file Excel
  Future scanBarcode() async {
    try {
      var result = await BarcodeScanner.scan();
      setState(() {
        barcode = result.rawContent;
      });

      // Gửi yêu cầu GET đến API để lấy thông tin sinh viên
      var response = await http.get(
          Uri.parse('http://644dc47f4e86e9a4d8eb4fdc.mockapi.io/students'));
      if (response.statusCode == 200) {
        var students = jsonDecode(utf8.decode(response.bodyBytes));
        var matchingStudent = students.firstWhere(
            (student) => student['Stuld'] == barcode,
            orElse: () => null);
        if (matchingStudent != null) {
          setState(() {
            infoText =
                "THÔNG TIN SINH VIÊN\nMSV: ${matchingStudent['Stuld']}\nHọ tên: ${matchingStudent['LastName']} ${matchingStudent['FirstName']}\nNgày sinh: ${matchingStudent['DOB']}";
          });
        } else {
          setState(() {
            infoText = "Không tìm thấy thông tin cho mã vạch $barcode";
          });
        }
        var responselist = await http.get(Uri.parse(
            'https://644f5b52b61a9f0c4d20f978.mockapi.io/liststudents'));
        if (responselist.statusCode == 200) {
          var events = jsonDecode(utf8.decode(responselist.bodyBytes));
          var existingBarcode = events.firstWhere(
              (event) =>
                  event['STU_ID'] == barcode &&
                  event['EVE_ID'] == widget.data['eventName'],
              orElse: () => null);
          if (existingBarcode != null) {
            // Nếu mã vạch đã tồn tại trong danh sách, thông báo cho người dùng
            setState(() {
              infoText = "Sinh Viên Này Đã Được Điểm Danh";
            });
          } else {
            // Nếu mã vạch chưa tồn tại trong danh sách, gửi yêu cầu POST để lưu thông tin
            var response = await http.post(
              Uri.parse(
                  'https://644f5b52b61a9f0c4d20f978.mockapi.io/liststudents'),
              body: {
                'STU_ID': barcode,
                'LastName': matchingStudent['LastName'],
                'FirstName': matchingStudent['FirstName'],
                'EVE_ID': widget.data['eventName'],
                'CreateDate': widget.data['eventDate'],
              },
            );
            if (response.statusCode == 201) {
              // Nếu lưu thông tin mã vạch thành công
              setState(() {
                liststudents++;
                infoText = "Điểm Danh Thành Công $liststudents Sinh Viên";
                // Tăng giá trị của liststudents lên 1
                //Lưu giá trị biến vào bộ nhớ đệm của ứng dụng:
                saveListStudents(liststudents);
                isEventsEmpty = false;
              });
            } else {
              // Nếu lưu thông tin mã vạch không thành công
              setState(() {
                infoText = "Lỗi khi lưu thông tin mã vạch";
              });
            }
          }
        } else {
          // Nếu lấy danh sách không thành công
          setState(() {
            infoText = "Lỗi khi lấy danh sách mã vạch";
          });
        }
      }
    } catch (e) {
      setState(() {
        infoText = "Không tìm thấy thông tin cho mã vạch $barcode";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Điểm Danh Sự kiện',
      home: Scaffold(
        appBar: AppBar(
          title: const Text(
            'Điểm Danh',
            style: TextStyle(
              fontSize: 27,
              color: Colors.white,
              fontWeight: FontWeight.bold,
            ),
          ),
          backgroundColor: const Color(0xff761d1f),
          leading: IconButton(
            onPressed: () {
              Navigator.pop(context);
            },
            icon: const Icon(Icons.arrow_back),
          ),
        ),
        body: Center(
          child: Column(
            // mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              const Text(
                'Thông tin sự kiện:',
                style: TextStyle(
                  fontSize: 27,
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text.rich(
                TextSpan(
                  text: "Tên sự Kiện:",
                  style: const TextStyle(
                    fontSize: 16,
                  ),
                  children: [
                    TextSpan(
                      text: "${widget.data['eventName']}",
                      style: const TextStyle(
                        color: Color(0xff761d1f),
                        fontFamily: AutofillHints.newUsername,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                ),
              ),
              Text.rich(
                TextSpan(
                  text: "Ngày diễn ra:",
                  style: const TextStyle(
                    fontSize: 16,
                  ),
                  children: [
                    TextSpan(
                      text: " ${widget.data['eventDate']}",
                      style: const TextStyle(
                        color: Color(0xff761d1f),
                        fontFamily: AutofillHints.newUsername,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                ),
              ),
              Text.rich(
                TextSpan(
                  text: "Tổng Sinh Viên Tham Gia: ",
                  style: const TextStyle(
                    fontSize: 16,
                  ),
                  children: [
                    TextSpan(
                      text: "$liststudents",
                      style: const TextStyle(
                        color: Color(0xff761d1f),
                        fontFamily: AutofillHints.newUsername,
                        fontWeight: FontWeight.bold,
                      ),
                    )
                  ],
                ),
              ),
              const SizedBox(height: 20),
              isEventsEmpty
                  ? Container()
                  : ElevatedButton(
                      onPressed: () {
                        exportToExcel();
                      },
                      style: ElevatedButton.styleFrom(
                        backgroundColor: const Color(0xff21a366),
                      ),
                      child: const Text("Xuất File Excel"),
                    ),
              // Text('Tên sự kiện: ${widget.data['eventName']}'),
              //Text('Ngày diễn ra: ${widget.data['eventDate']}'),
              const SizedBox(height: 20),
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xff761d1f),
                ),
                onPressed: scanBarcode,
                child: const Text(
                  "Điểm Danh",
                  style: TextStyle(
                    fontSize: 18,
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              const SizedBox(height: 20),
              Text(
                infoText,
                style: const TextStyle(
                  fontSize: 18,
                  color: Color(0xff761d1f),
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
