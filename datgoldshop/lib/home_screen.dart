import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:datgoldshop/quetma.dart';
import 'package:http/http.dart' as http;
import 'package:datgoldshop/quetma.dart';

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key});

  @override
  HomePageState createState() => HomePageState();
}

class HomePageState extends State<MyHomePage> {
  List<dynamic> data = [];

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  Future<void> fetchData() async {
    final response = await http
        .get(Uri.parse('https://644f5b52b61a9f0c4d20f978.mockapi.io/events'));

    if (response.statusCode == 200) {
      setState(() {
        data = json.decode(utf8.decode(response.bodyBytes));
      });
    } else {
      throw Exception('Failed to load data');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        centerTitle: true,
        backgroundColor: const Color(0xff761d1f),
        // title: Image.asset(
        //   'assets/images/logo/cdsg.png',
        //   width: 100,
        //   height: 50,
        // ),
        title: const Text(
          " Chọn Sự Kiện",
          style: TextStyle(
            fontSize: 27,
            fontWeight: FontWeight.bold,
            color: Colors.white,
          ),
        ),
        leading: IconButton(
          onPressed: () {},
          icon: const Icon(Icons.add_circle_outline),
        ),
        actions: [
          IconButton(
            onPressed: () {
              // Navigator.push(
              //   context,
              //   MaterialPageRoute(builder: (context) => const QuetMa()),
              // );
            },
            icon: const Icon(Icons.crop_free_outlined),
          ),
        ],
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              itemCount: data.length,
              itemBuilder: (BuildContext context, index) {
                return GestureDetector(
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) =>  QuetMa(data[index],index)),
                    );
                  },
                  child: Card(
                    color: Colors.grey[300], // Màu nền của Card
                    shape: RoundedRectangleBorder(
                      // Định dạng của viền của Card
                      borderRadius: BorderRadius.circular(10.0),
                      side: const BorderSide(color: Color(0xff761d1f)),
                    ),
                    child: ListTile(
                      title: Text(data[index]['eventName']),
                      subtitle: Text(data[index]['eventDate']),
                    ),
                  ),
                );
              },
            ),
          )
        ],
      ),
    );
  }
}
