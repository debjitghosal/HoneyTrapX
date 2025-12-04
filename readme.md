# 🛡️ HoneyTrapX – Deception-Based Intruder Tracking & Evidence Capture System

HoneyTrapX is a cybersecurity deception system engineered to **silently capture photos, GPS trails, device data, and activity logs** from intruders who access the page.  
Designed as a controlled honeypot environment, it enables **real-time threat intelligence** and **digital evidence collection** without alerting the target.

---

## 🗂️ Table of Contents
- [Features](#features)
- [Project Structure](#project-structure)
- [System Architecture](#system-architecture)
- [Installation](#installation)
- [Accessing the Honeypot](#accessing-the-honeypot)
- [Admin Dashboard](#admin-dashboard)
- [Log Format](#log-format)
- [Technologies Used](#technologies-used)
- [Security Notice](#security-notice)
- [Author](#author)
- [Quick Start Summary](#quick-start-summary)

---

## ⭐ Features

### 📸 Stealth Photo Capture
- Completely hidden front-camera activation  
- No video preview shown to the intruder  
- **13 total photos** auto-captured  
  - 3 ultra-fast sequential photos  
  - 10 rapid photos (350ms gap)  
- Stored safely in `/uploads`  
- Logged with timestamp + IP + location  

---

### 📍 Continuous GPS Tracking
- Location updates every **3 seconds**  
- Reverse geocoded to full address (OpenStreetMap API)  
- Logged in `log.txt`  
- Works globally using Cloudflare tunnels  
- Admin can click address → open in Google Maps  

---

### 🎭 Deception-Based Frontend
- Fake “Loading…” UI  
- Smooth green progress bar animation  
- Fake “Payment Success” QR code  
- Appears like a harmless webpage to the target  
- All tracking is invisible

---

### 🕵️‍♂️ Admin Dashboard
- Dark-mode UI  
- Refreshes automatically every 6 seconds  
- Shows:
  - Captured photos  
  - Shortened address  
  - Full address on click  
  - Map link  
  - Activity logs  
- Clean modern interface for reviewing collected evidence

---

## 📁 Project Structure

HoneyTrapX/
│
├── index.php # Main deception honeypot (camera + GPS)
├── continuous.php # Background GPS tracker endpoint
├── admin.php # Admin dashboard
├── log.txt # Combined logs (photos + GPS)
├── uploads/ # All captured images
├── logo.png # HoneyTrapX shield logo
└── README.md # Documentation

less
Copy code

---

## 🏗️ System Architecture

```mermaid
flowchart TD
    A[User Device] -->|Opens Honeypot| B[index.php]
    B -->|Auto Photos| C[uploads/]
    B -->|GPS Stream| D[continuous.php]

    C -->|Image Path| E[log.txt]
    D -->|Lat/Lon + Address| E

    E -->|Read Logs| F[admin.php]
    F -->|Display Evidence| G[Admin]
🛠️ Installation
1️⃣ Install XAMPP
Install XAMPP and start Apache.

2️⃣ Move Project to htdocs
Copy HoneyTrapX to:

makefile
Copy code
C:\xampp\htdocs\HoneyTrapX
3️⃣ Local Access
Open:

arduino
Copy code
http://localhost/HoneyTrapX/
📱 Accessing the Honeypot From Phone (Same WiFi)
Find laptop local IP:
Example:

Copy code
192.168.1.8
Open on phone:

cpp
Copy code
http://192.168.1.8/HoneyTrapX/
🌍 Global Access (Mobile Data Supported)
Use Cloudflare Tunnel (recommended for HTTPS permission prompts):

nginx
Copy code
cloudflared tunnel --url http://localhost/HoneyTrapX
You’ll receive a global HTTPS URL like:

arduino
Copy code
https://shadow-trace-edge.trycloudflare.com
This works:

On mobile data

Across countries

With correct camera + GPS permissions

🖥️ Admin Dashboard
Local:

bash
Copy code
http://localhost/HoneyTrapX/admin.php
Cloudflare tunnel:

arduino
Copy code
https://your-link.trycloudflare.com/admin.php
Dashboard shows:

Latest photos

Reverse geocoded address

Click-to-expand full address

Google Maps links

Timestamp + IP logs

🧾 Log Format
📷 Photo Entry
yaml
Copy code
2025-12-04 12:01:37 | PHOTO | IP: 192.168.1.8 | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ | FILE: uploads/photo.jpg
📍 Continuous GPS Entry
yaml
Copy code
2025-12-04 12:01:40 | CONTINUOUS | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ
🧰 Technologies Used
Component	Technology
Frontend	HTML, CSS, JavaScript
Backend	PHP (XAMPP Apache)
Camera Access	getUserMedia()
GPS Tracking	Geolocation API
Reverse Geocoding	OpenStreetMap Nominatim
Tunneling	Cloudflare Tunnel
Logging	Custom PHP logger

🔐 Security Notice
HoneyTrapX is intended strictly for cybersecurity research and academic purposes.

Do NOT use it for:
❌ Privacy invasion
❌ Surveillance of innocent users
❌ Illegal monitoring

You may use it for:
✔ Honeypot research
✔ Cyber defense simulations
✔ Threat analysis
✔ Academic submissions
✔ Ethical attacker behavior studies

👤 Author
Debjit Ghosal
Cybersecurity • AI • Full-Stack Engineering

⚡ Quick Start Summary
bash
Copy code
# Start XAMPP Apache
# Open the honeypot on laptop
http://localhost/HoneyTrapX/

# Open from phone (same WiFi)
http://192.168.x.x/HoneyTrapX/

# Global access (HTTPS)
cloudflared tunnel --url http://localhost/HoneyTrapX

# Admin panel
http://localhost/HoneyTrapX/admin.php
yaml
