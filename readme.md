````md
# 🛡️ HoneyTrapX  
### Deception-Driven Threat Intelligence & Intruder Evidence Capture System  
<p align="center"><img src="logo.png" width="180"></p>

HoneyTrapX is a stealth cyber-deception system designed to collect **attacker evidence** — including camera photos, GPS location, movement trails, and device information — without revealing any monitoring activity.  

Built as a security research project, HoneyTrapX acts as a **honeypot-style trap**, giving you deep visibility into malicious users interacting with a fake interface.

---

## 🚀 Overview

HoneyTrapX silently collects:

- **13 auto-captured facial photos** (3 fast + 10 rapid)  
- **Continuous real-time GPS tracking** (every ~3 seconds)  
- **Full reverse-geocoded addresses**  
- **Timestamps, device IP, and session activity**  
- **Fake loading flow ending with a QR "payment success" page**

All evidence is stored locally and displayed in a **dark-themed realtime admin dashboard**.

---

## 🏗️ System Architecture (High-Level Flow)

```mermaid
flowchart TD
    A[User Device] -->|Opens Deception Page| B[index.php]
    B -->|Stealth Photo Capture| C[uploads/]
    B -->|Continuous GPS Updates| D[continuous.php]

    C -->|Image Path| E[log.txt]
    D -->|Geo Data + Address| E

    E -->|Read Evidence| F[admin.php]
    F -->|Visualization + Admin Review| G[Admin]
````

---

## 🔧 Key Features

### 📸 Stealth Photo Capture

* Hidden front-camera stream
* No preview shown to the visitor
* 13 automatic captures:

  * **3 ultra-fast photos** (within milliseconds)
  * **10 rapid photos** (350ms apart)
* Stored in `uploads/`
* Logged with timestamps + IP + GPS

---

### 📍 Continuous GPS Monitoring

* Watch-based tracking updates every 3 seconds
* Reverse-geocoded via OpenStreetMap
* Stored in `log.txt`
* Shows approximate address + link to Google Maps

---

### 🎭 Deception Frontend

* Fake “Loading…” UI
* Smooth green progress bar
* Transitions to a fake “Payment Successful” QR
* No visible indication of monitoring
* Designed to appear completely harmless

---

### 🕵️‍♂️ Admin Dashboard

* Auto refreshes every 6 seconds
* Displays:

  * Latest photos
  * Geo-location + click-to-expand address
  * Integrated Google Maps links
  * Full activity logs
* Dark theme for visual clarity

---

## 📂 Project Structure

```
HoneyTrapX/
│
├── index.php          # Main honeypot interface (camera + GPS + deception flow)
├── continuous.php     # GPS receiving endpoint
├── admin.php          # Admin dashboard UI
├── log.txt            # Combined logs (photos + GPS)
├── uploads/           # All photos captured from attackers
├── logo.png           # HoneyTrapX shield logo
└── README.md          # Documentation
```

---

## ⚙️ Installation Guide

### 1️⃣ Install XAMPP

Start **Apache**.

### 2️⃣ Place HoneyTrapX Into htdocs

```
C:\xampp\htdocs\HoneyTrapX
```

### 3️⃣ Open Locally

```
http://localhost/HoneyTrapX/
```

### 4️⃣ Access From Mobile (Same WiFi)

Find your laptop's IP (example):

```
192.168.1.8
```

Open on phone:

```
http://192.168.1.8/HoneyTrapX/
```

### 5️⃣ Global Access (Works on Mobile Data)

Use Cloudflare Tunnel:

```
cloudflared tunnel --url http://localhost/HoneyTrapX
```

You’ll get a public HTTPS URL like:

```
https://shadow-trace-edge.trycloudflare.com
```

Use the same URL + `/admin.php` for dashboard.

---

## 📜 Log Format

### Photo Entry

```
2025-12-04 12:01:37 | PHOTO | IP: 192.168.1.8 | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ | FILE: uploads/abc.jpg
```

### Continuous GPS Entry

```
2025-12-04 12:01:40 | CONTINUOUS | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ
```

---

## 🧠 Tech Stack

| Layer             | Technology                 |
| ----------------- | -------------------------- |
| Frontend          | HTML, CSS, JavaScript      |
| Backend           | PHP                        |
| Camera            | getUserMedia()             |
| GPS               | JavaScript Geolocation API |
| Reverse Geocoding | OpenStreetMap Nominatim    |
| Server            | Apache (XAMPP)             |
| Tunnel            | Cloudflare Tunnel          |

---

## ⚠️ Security & Ethics Notice

HoneyTrapX is built **strictly for cybersecurity research and academic learning**.

Do **NOT** use it for:
❌ Surveillance
❌ Targeting innocent users
❌ Illegal data capture
❌ Harassment or unauthorized monitoring

You may use it for:
✔ Cyber-defense experiments
✔ Studying malicious actors
✔ Evidence gathering within legal context
✔ University projects
✔ honeypot research

---

## 📤 GitHub Commands

```bash
git init
git add .
git commit -m "Initial HoneyTrapX commit"
git remote add origin https://github.com/debjitghosal/HoneyTrapX.git
git branch -M main
git push -u origin main
```

---

## 👨‍💻 Author

**Debjit Ghosal**
Cybersecurity & AI Enthusiast
(For academic research purposes only)

```
```
