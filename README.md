# Nile Academy Learning Management System

Nile Academy LMS is a comprehensive web-based learning management system designed to facilitate educational processes between administrators, teachers, and students.

## 🌟 Features

### For Administrators
- Manage teachers, students, and courses
- Monitor attendance and payments
- Handle course assignments
- View system analytics

### For Teachers
- Manage lectures and schedules
- Track student attendance
- View assigned courses
- Monitor student progress

### For Students
- View enrolled courses
- Check lecture schedules
- Manage account settings

## 🛠️ Technical Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP

## 📋 Prerequisites

- XAMPP (or similar local server environment)
- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, or Edge)

## 🚀 Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/NileAcademy.git
   ```

2. Place the project in your XAMPP's htdocs directory:
   ```
   /xampp/htdocs/NileAcademy
   ```

3. Import the database:
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `NileAcademy`
   - Import the `03-RestOfDB.txt` file

4. Configure the database connection:
   - Open `Config.php`
   - Update database credentials if needed

5. Start XAMPP:
   - Start Apache and MySQL services

6. Access the application:
   ```
   http://localhost/NileAcademy
   ```

## 👥 Default Users

### Admin
- Username: mohamed hashim
- Password: admin1

### Teacher
- Username: Ahmed Samir
- Password: teacher2

### Student
- Username: ahmed ali
- Password: student1

## 📁 Project Structure

```
NileAcademy/
├── admin-*.php         # Admin management files
├── student-*.php       # Student interface files
├── styles/            # CSS files
├── uploads/           # Uploaded files
├── Config.php         # Database configuration
├── Login.php          # Authentication
└── 03-RestOfDB.txt    # Database schema
```

## 🔒 Security Features

- Role-based access control
- Session management
- Input validation
- SQL injection prevention

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👨‍💻 Authors

- **Nile Academy Team** - *Initial work*

## 🙏 Acknowledgments

- XAMPP Development Team
- All contributors who have helped shape this project

## 📞 Support

For support, please contact the development team or open an issue in the repository.

---

Made with ❤️ by Nile Academy Team 