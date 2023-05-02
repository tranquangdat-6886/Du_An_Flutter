import 'dart:async';

import 'package:datgoldshop/login_screen.dart';
import 'package:flutter/material.dart';

class TimeLoad extends StatefulWidget {
  const TimeLoad({super.key});
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<TimeLoad> {
  //làm chuyển tới trang chính sau mấy giây
  @override
  void initState() {
    super.initState();
    // Chuyển đến trang chính sau 3 giây
    Timer(const Duration(seconds: 3), () {
      Navigator.pushReplacement(context,
          MaterialPageRoute(builder: (context) => const LoginScreen()));
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            // SpinKitFadingCube(
            //   color: Colors.white,
            //   size: 50.0,
            // ),
            //hình ảnh logo của trường
            Image.asset(
              'assets/images/logo/cdsg.png',
              height: 100,
              fit: BoxFit.cover,
            ),
            const SizedBox(height: 10),
            // const Text(
            //   'SAIGONTECH',
            //   style: TextStyle(
            //     fontSize: 25,
            //     color: Colors.black,
            //     fontWeight: FontWeight.bold,
            //   ),
            // ),
          ],
        ),
      ),
    );
  }
}
