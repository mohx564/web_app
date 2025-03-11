require('dotenv').config();
const express = require('express');
const mysql = require('mysql');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const port = process.env.PORT || 3000;

app.use(cors());
app.use(bodyParser.json());

// إعداد الاتصال بقاعدة البيانات
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',  // يفضل تغييرها إذا كنت تستخدم اسم مستخدم مختلف
    password: '',   // تأكد من أن كلمة المرور تتطابق مع إعدادات XAMPP
    database: 'mydatabase'
});

db.connect(err => {
    if (err) {
        console.error('فشل الاتصال بقاعدة البيانات:', err);
        return;
    }
    console.log('تم الاتصال بقاعدة البيانات بنجاح');
});

// **إنشاء مستخدم جديد (POST)**
app.post('/users', (req, res) => {
    const { name, email } = req.body;
    if (!name || !email) {
        return res.status(400).json({ error: "يجب إدخال الاسم والبريد الإلكتروني" });
    }

    const sql = "INSERT INTO users (name, email) VALUES (?, ?)";
    db.query(sql, [name, email], (err, result) => {
        if (err) {
            return res.status(500).json({ error: "حدث خطأ أثناء إدخال البيانات", details: err });
        }
        res.status(201).json({ message: "تم إضافة المستخدم بنجاح", userId: result.insertId });
    });
});

// **جلب جميع المستخدمين (GET)**
app.get('/users', (req, res) => {
    const sql = "SELECT * FROM users";
    db.query(sql, (err, results) => {
        if (err) {
            return res.status(500).json({ error: "حدث خطأ أثناء جلب البيانات", details: err });
        }
        res.json(results);
    });
});

// تشغيل السيرفر
app.listen(port, () => {
    console.log(`السيرفر يعمل على http://localhost:${port}`);
});
