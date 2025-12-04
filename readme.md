# 🛡️ HoneyTrapX – Deception-Based Intruder Tracking & Evidence Capture System

HoneyTrapX is a cybersecurity deception system engineered to **silently capture photos, GPS trails, device data, and activity logs** from intruders who access the page.  
Designed as a controlled honeypot environment, it enables **real-time threat intelligence** and **digital evidence collection** without alerting the target.

---

## 🗂️ Table of Contents
- [Features](#features)
- [Admin Dashboard](#admin-dashboard)
- [Project Structure](#project-structure)
- [System Architecture](#system-architecture)
- [Quick Start Summary](#quick-start-summary)
- [Technologies Used](#technologies-used)
- [Security Notice](#security-notice)
- [Author](#author)

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
<img width="258" height="392" alt="Screenshot 2025-12-04 134900" src="https://github.com/user-attachments/assets/ea01cd2a-3b39-4ad7-8097-cad984c6f3a9" />

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

<img width="152" height="275" alt="Screenshot 2025-12-04 135819" src="https://github.com/user-attachments/assets/a696b4ae-4fd0-44fc-87a1-8cee220254e2" />


---

## 🏗️ System Architecture

    A[User Device] -->|Opens Honeypot| B[index.php]
    B -->|Auto Photos| C[uploads/]
    B -->|GPS Stream| D[continuous.php]C -->|Image Path| E[log.txt]
    D -->|Lat/Lon + Address| E

    E -->|Read Logs| F[admin.php]
    F -->|Display Evidence| G[Admin]
    
# ⚡ Quick Start Summary
Start XAMPP Apache 

Open PowerShell:


Terminal 1 : 

cd C:\xampp\htdocs\gps_tracker

& "C:\xampp\php\php.exe" -S localhost:8000


Terminal 2:

Global access (HTTPS): cloudflared tunnel --url http://localhost/HoneyTrapX (unique url genrated by clouadfare)

Admin panel: 
http://localhost/HoneyTrapX/admin.php

<img width="1902" height="729" alt="Screenshot 2025-12-04 134812" src="https://github.com/user-attachments/assets/0dcb71e9-eeae-40dc-879a-db49b46c06b6" />
<img width="1857" height="800" alt="Screenshot 2025-12-04 134825" src="https://github.com/user-attachments/assets/b187d1bd-90fb-466d-ac21-aa58edb00623" />


# 🔥Technologies Used:


🐘 PHP 

⚡ JavaScript 

🎨 CSS3 

🧱 HTML5  

🛠️ Apache (XAMPP) 

🌐 Cloudflare Tunnel 

📍 Geolocation API 

📸 Camera API (getUserMedia) 

🗺️ OpenStreetMap API  

🛡️ Cloudflare Security


# 🔐 Security Notice
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

# 👤 Author
Debjit Ghosal
