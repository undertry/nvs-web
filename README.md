### 📄 `nvs-web` – README


# 🌐 NVS Web – Network Vulnerability Scanner Interface

> `nvs-web` is the official frontend of the **NVS (Network Vulnerability Scanner)** project. It provides a clean, interactive dashboard to visualize and control network scans powered by [`nvs-core`](https://github.com/undertry/nvs-core). Built using **CodeIgniter 4**, enhanced with **GSAP** for rich animations, and styled with custom CSS and JavaScript.

![PHP](https://img.shields.io/badge/PHP-8.0%2B-blue)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-red)
![License](https://img.shields.io/github/license/undertry/nvs-web)
![Status](https://img.shields.io/badge/Status-Active-brightgreen)

---

## 🧰 What It Does

- 🎛️ Offers a modern web UI for NVS
- 📡 Sends scan requests to `nvs-core` via API
- 📊 Displays scan results dynamically
- 💡 Uses animations (GSAP) to enhance UX
- ⚙️ Works seamlessly in local environments like XAMPP

---

## ⚙️ Tech Stack

| Category       | Technology            |
|----------------|------------------------|
| Backend        | PHP 8.x, CodeIgniter 4 |
| Frontend       | HTML5, CSS3, JavaScript |
| Animations     | GSAP (GreenSock)      |
| Server Env     | XAMPP / Apache        |
| Database       | MySQL (optional)      |

---

## 🛠️ Requirements

- PHP 8.0+
- XAMPP / Apache server
- Composer (recommended)
- [`nvs-core`](https://github.com/undertry/nvs-core) running locally or remotely

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/undertry/nvs-web.git
```

### 2. Move to Your Web Server Directory

If using XAMPP on Windows:

```bash
mv nvs-web /c/xampp/htdocs/
```

### 3. Configure `.env`

Copy the example environment file and set the base URL + API endpoints:

```bash
cp .env.example .env
```

Edit the file and set:

```env
app.baseURL = 'http://localhost/nvs-web/public'
api.nvsCoreURL = 'http://localhost:5000'  # Flask API from nvs-core
```

### 4. Install Dependencies

```bash
composer install
```

### 5. Generate Key & Run Migrations

```bash
php spark key:generate
php spark migrate
```

### 6. Start the Server

```bash
php spark serve
```

Then go to: [http://localhost:8080](http://localhost:8080)

---

## 📁 Project Structure

```
nvs-web/
├── app/                → Core application files (Controllers, Views, Models)
├── public/             → Entry point (index.php)
├── animations/         → GSAP-powered animation scripts
├── .env                → Environment configuration
└── README.md           → This file
```

---

## 🔗 Related Projects

- [nvs-core](https://github.com/undertry/nvs-core) – Core CLI & scanning engine for the NVS project.

---

## 👥 Authors

- **Frontend Design & Animations:** [@undertry (Tiago Comba)](https://github.com/undertry)
- **Backend & API Integration:** [@ezequielmonteverde](https://github.com/ezequielmonteverde)

---

## 📄 License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for more details.

---

> “NVS: scan smarter, not harder.” 🔐
