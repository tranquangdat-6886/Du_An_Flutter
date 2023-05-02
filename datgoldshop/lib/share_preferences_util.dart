import 'package:shared_preferences/shared_preferences.dart';

// Lưu trữ thời gian đăng nhập thành công vào bộ nhớ cục bộ
Future<void> saveLoginTime() async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
  prefs.setInt('loginTime', DateTime.now().millisecondsSinceEpoch);
}

// Kiểm tra xem người dùng đã đăng nhập thành công trong vòng 1 phút hay không
Future<bool> isLoginValid() async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
int? loginTime = prefs.getInt('loginTime');
if (loginTime == null) {
  return false;
}
int currentTime = DateTime.now().millisecondsSinceEpoch;
return (currentTime - loginTime) < 60000; // Kiểm tra trong vòng 1 phút
}


// Xóa thời gian đăng nhập khỏi bộ nhớ cục bộ khi người dùng đăng xuất
Future<void> clearLoginTime() async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
  await prefs.remove('loginTime');
}
