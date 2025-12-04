🛡️ HoneyTrapX
Deception-Driven Threat Intelligence & Intruder Evidence Collection System
<p align="center"> <img src="logo.png" width="240"> </p>

HoneyTrapX is a stealth honeypot system engineered to silently gather photos, GPS location, device intelligence, and movement trails from threat actors who access the page.

Originally built to study attacker behavior, HoneyTrapX functions as a deception environment that captures digital evidence without the intruder realizing it.

📘 System Diagrams
🏗️ 1. System Architecture
flowchart TD
    A[User Device<br>(Phone/Browser)] -->|Camera + GPS Permissions| B[index.php]

    B -->|Auto Capture 13 Photos| C[Uploads Folder]
    B -->|Continuous GPS<br>Location Updates| D[continuous.php]

    C -->|Photo File Path| E[log.txt]
    D -->|Lat/Lon + Address| E

    E -->|Log Reading| F[admin.php<br>(Admin Dashboard)]

    F -->|Display Logs + Photos| G[Admin User]

🔄 2. Data Flow Diagram (DFD Level 1)
flowchart LR
    User[User] -->|Open Page| UI[index.php]
    UI -->|Capture Photos| Camera[Camera API]
    UI -->|Get GPS| GPS[Geolocation API]

    Camera -->|13 Photos| Backend[index.php (PHP)]
    GPS -->|Lat/Lon| Backend

    Backend -->|Store Image| Uploads[(uploads/)]
    Backend -->|Write Log| Logs[(log.txt)]

    Admin[Admin User] -->|View Dashboard| Dashboard[admin.php]
    Dashboard -->|Read Data| Logs
    Dashboard -->|Read Photos| Uploads

🧪 3. Use Case Diagram
flowchart LR
    User((User)) --> |Opens Page| System[(HoneyTrapX<br>Deception System)]
    User --> |Grants Permissions| System

    Admin((Admin)) --> |Views Real-Time Intelligence| Dashboard[Admin Panel]

    System --> |Capture Photos| Uploads[(uploads/)]
    System --> |Log GPS + Address| Logs[(log.txt)]
    Dashboard --> |Displays Logs + Images| Admin

📸 4. Sequence Diagram
sequenceDiagram
    participant U as User
    participant B as Browser (JS)
    participant P as PHP Backend
    participant F as Storage (Uploads + Logs)

    U->>B: Open index.php
    B->>U: Request Camera + GPS Permissions
    U->>B: Allow

    B->>B: Start Hidden Camera Stream
    B->>P: Upload Photo #1
    P->>F: Save Photo + Log

    B->>P: Upload Remaining 12 Photos

    loop Every 3 seconds
        B->>B: Get GPS
        B->>P: Send Lat/Lon + Address
        P->>F: Append GPS Log
    end

    B->>U: Show Fake QR Code (Completed)

🔁 5. Activity Diagram
flowchart TD
    A([User Opens Page]) --> B{Permissions Granted?}
    B -->|No| A
    B -->|Yes| C[Start Hidden Camera]

    C --> D[Capture 3 Fast Photos]
    D --> E[Capture 10 Rapid Photos]

    E --> F[Begin Continuous GPS Tracking]

    F --> G[Write GPS Logs]

    G --> H[Fill Progress Bar]

    H --> I{13 Photos Done?}
    I -->|No| H
    I -->|Yes| J[Show QR Code]

    J --> K([End])

⚙️ Features
📸 Stealth Auto-Capture

Silent camera activation

No preview shown to target

13 photos total:

3 ultra-fast

10 rapid (350ms gap)

Stored automatically in /uploads/.

📍 Continuous GPS Tracking

Runs every 3 seconds

Converts GPS → full address using OpenStreetMap Nominatim

Logged in log.txt

Works globally via Cloudflare HTTPS tunnel

🛡️ Deception-Based Frontend

Shows a fake loading screen

Smooth green progress bar

Ends with a “Payment Successful” QR code

Target sees nothing suspicious

📊 Real-Time Admin Dashboard

Dark theme UI

Auto refresh every 6 seconds

Displays:

Latest photos

Truncated address below

Expand full address on click

Google Maps location link

Full logs table

📂 Project Structure
HoneyTrapX/
│
├── index.php          # Deception frontend (camera + GPS)
├── continuous.php     # GPS receiver
├── admin.php          # Admin dashboard
├── log.txt            # Logs (GPS + photos)
├── uploads/           # Stored images
├── logo.svg           # HoneyTrapX shield logo
└── README.md          # Documentation

🖥️ Installation Guide
1️⃣ Install XAMPP

Start Apache.

2️⃣ Move Project to htdocs

Copy folder to:

C:\xampp\htdocs\HoneyTrapX

3️⃣ Open On Laptop
http://localhost/HoneyTrapX/

4️⃣ Open on Phone (Same WiFi)

Find laptop IP:

192.168.x.x


Then visit:

http://192.168.x.x/HoneyTrapX/

5️⃣ Open Anywhere (Mobile Data) — Cloudflare Tunnel

Run:

cloudflared tunnel --url http://localhost/HoneyTrapX


You'll get a public HTTPS URL like:

https://shadow-trace-edge.trycloudflare.com


✔ Works globally
✔ HTTPS permissions enabled

6️⃣ Admin Panel

Local:

http://localhost/HoneyTrapX/admin.php


Tunnel:

https://your-url.trycloudflare.com/admin.php

📝 Log Format
Photo Entry
2025-12-04 12:01:37 | PHOTO | IP: 192.168.1.8 | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ | FILE: uploads/abc.jpg

Continuous GPS Entry
2025-12-04 12:01:40 | CONTINUOUS | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ

🤖 Technology Stack
Area	Tech
Frontend	HTML, CSS, JS
Backend	PHP
GPS	Geolocation API
Camera	getUserMedia()
Reverse Geocoding	OpenStreetMap API
Server	Apache (XAMPP)
Tunnel	Cloudflare Tunnel
🛡️ Security Notice

HoneyTrapX is designed as a cybersecurity research honeypot, not for harming or attacking users.

Do not use it:
❌ To trick innocent users
❌ For surveillance
❌ Against real attackers outside legal scope

Use strictly for:
✔ Research
✔ Evidence collection
✔ Cyber defense experiments
✔ Academic project work

📤 GitHub Deployment
git init
git add .
git commit -m "HoneyTrapX initial commit"
git remote add origin https://github.com/<username>/HoneyTrapX.git
git branch -M main
git push -u origin main

🧑‍💻 Author

Debjit Ghosal

(This is for educational purspose only.)