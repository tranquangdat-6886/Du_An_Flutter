import 'dart:convert';

import 'package:datgoldshop/home_screen.dart';
import 'package:datgoldshop/share_preferences_util.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  bool hidePassword = true;
  IconData icons = Icons.visibility;
  final _userName = TextEditingController();
  final _userPasswrod = TextEditingController();
  @override
  Widget build(BuildContext context) {
    const MaterialApp(
      color: Color(0xff761d1f),
    );

    return Scaffold(
        resizeToAvoidBottomInset:
            false, //dùng để làm nội dung sẽ không thay đổi khi bàn phím điện thoại hiển thị
        body: Center(
          child: Container(
            alignment: Alignment.center,
            height: 500,
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 30),
              child: Column(children: [
                Image.asset(
                  'assets/images/logo/cdsg.png',
                  height: 100,
                  fit: BoxFit.cover,
                ),
                TextField(
                  controller: _userName,
                  keyboardType: TextInputType.text,
                  decoration: const InputDecoration(
                    border: OutlineInputBorder(),
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color(0xff761d1f)), // màu viền khi focus
                    ),
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color(0xff761d1f)), // màu viền khi không focus
                    ),
                    labelStyle: TextStyle(
                      color: Color(0xff761d1f),
                      fontWeight: FontWeight.bold,
                      fontSize: 18,
                    ),
                    contentPadding:
                        EdgeInsets.symmetric(horizontal: 16, vertical: 10),
                    hintText: "Please enter your username",
                    labelText: "UserName",
                    fillColor: Colors.white,
                  ),
                  cursorRadius: const Radius.circular(10),
                ),
                const SizedBox(
                  height: 27,
                ),
                TextField(
                  controller: _userPasswrod,
                  obscureText: hidePassword,
                  keyboardType: TextInputType.emailAddress,
                  decoration: InputDecoration(
                    focusedBorder: const OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color(0xff761d1f)), // màu viền khi focus
                    ),
                    enabledBorder: const OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color(0xff761d1f)), // màu viền khi không focus
                    ),
                    labelStyle: const TextStyle(
                      color: Color(0xff761d1f),
                      fontWeight: FontWeight.bold,
                      fontSize: 18,
                    ),
                    border: const OutlineInputBorder(),
                    contentPadding: const EdgeInsets.symmetric(
                        horizontal: 16, vertical: 10),
                    labelText: "Password",
                    hintText: "Please enter your password",
                    suffixIcon: IconButton(
                        onPressed: () {
                          setState(() {
                            hidePassword = !hidePassword;
                            icons = hidePassword
                                ? Icons.visibility
                                : Icons.visibility_off;
                          });
                        },
                        icon: Icon(
                          icons,
                          color: const Color(0xff761d1f),
                        )),
                  ),
                ),
                ElevatedButton(
                  onPressed: () =>
                      handleLogin(_userName.text, _userPasswrod.text),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xff761d1f),
                  ),
                  child: const Text(
                    "Login",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 21,
                    ),
                  ),
                )
              ]),
            ),
          ),
        ));
  }

  Future<bool> validateUser(String username, String password) async {
    final url =
        Uri.parse('http://644dc47f4e86e9a4d8eb4fdc.mockapi.io/accounts');
    final response = await http.get(url);
    if (response.statusCode == 200) {
      final List<dynamic> data = jsonDecode(response.body);
      for (final user in data) {
        if (user['username'] == username && user['password'] == password) {
          return true;
        }
      }
    }
    return false;
  }

  Future<void> handleLogin(String username, String password) async {
    if (await validateUser(username, password)) {
      // Đăng nhập thành công, chuyển hướng đến trang chính của ứng dụng
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => const MyHomePage()),
        (route) => false,
      );
    } else {
      // Hiển thị thông báo lỗi
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: const Text('Lỗi đăng nhập'),
          content: const Text(
              'Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại.'),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text('OK'),
            ),
          ],
        ),
      );
    }
  }
}
