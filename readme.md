🛡️ HoneyTrapX
Deception-Driven Threat Intelligence & Intruder Evidence Collection System
<p align="center"> <img src="logo.png" width="260"> </p>

HoneyTrapX is a stealth cyber deception system designed to monitor, analyze, and log intruder activity without detection.
It silently captures photos, GPS coordinates, and location movements, then displays this intelligence inside a real-time admin dashboard.

This project demonstrates browser-level intelligence gathering, client-side deception techniques, and backend evidence logging, making it ideal for academic submissions, cybersecurity portfolios, and defensive security demonstrations.

🚀 How HoneyTrapX Works (High-Level Overview)

When an intruder opens the page:

1️⃣ They see a fake loading screen
2️⃣ Browser requests Camera + GPS permissions
3️⃣ HoneyTrapX silently:

Captures 13 photos

Tracks GPS every 3 seconds

Converts GPS → full human-readable address

Saves all evidence

This intelligence flows into a professional admin dashboard where you can monitor all activity.

Let’s start with the high-level system architecture:

🏗️ System Architecture

This diagram explains how user activity travels through the system.

```mermaid
flowchart TD
    A[User Device] -->|Permissions + Access| B[index.php]
    B -->|Stealth Photos| C[Uploads/]
    B -->|GPS Data| D[continuous.php]

    C -->|Image Paths| E[log.txt]
    D -->|Coordinates + Address| E

    E -->|Read Logs| F[admin.php]
    F -->|View Evidence| G[Admin]


✔ Clean
✔ Minimal
✔ Perfect for recruiters

🔍 Data Capture Workflow

HoneyTrapX captures two forms of data simultaneously:

📸 1. Image Capture Pipeline

Camera is opened silently

User does not see their preview

13 photos captured → uploaded → logged

📍 2. GPS Tracking Pipeline

WatchPosition constantly streams:

latitude

longitude

precise address

Logged every 3 seconds

Here is the data flow between components:

🔄 Data Flow Diagram (DFD – Level 1)
flowchart LR
    User --> index.php --> Backend[(PHP Backend)]
    Backend --> Uploads[(Images)]
    Backend --> Logs[(GPS + Photo Logs)]

    Admin --> admin.php --> Logs
    Admin --> admin.php --> Uploads


This gives recruiters a clear, precise idea of the system without overwhelming them.

🧪 Intruder Interaction Sequence

Now let’s break down what actually happens on the browser side:

sequenceDiagram
    participant U as User
    participant B as Browser (JS)
    participant P as PHP Backend
    participant F as Storage

    U->>B: Open HoneyTrapX
    B->>U: Request Camera + GPS Permissions
    U->>B: Allow

    B->>B: Start Hidden Camera Capture
    B->>P: Upload Multiple Photos
    P->>F: Save Evidence

    loop Every 3 Seconds
        B->>B: Acquire GPS
        B->>P: Send GPS + Address
        P->>F: Write to Logs
    end

    B->>U: Show Fake Success QR


This sequence diagram is clean, professional, recruiter-friendly.

🔁 System Behavior Flow
flowchart TD
    A[User Opens Page] --> B[Grant Permissions]
    B --> C[Auto-Capture Photos]
    C --> D[Continuous GPS Tracking]
    D --> E[Log Evidence]
    E --> F[Show Fake QR]


This diagram summarizes the complete flow concisely.

⚙️ Key Features
📸 Stealth Auto-Capture

Completely invisible to the user

3 very-fast + 10 rapid photos

Stored inside /uploads/

Logged with timestamps

📍 Continuous GPS Tracking

High-accuracy mode

Captures every 3 seconds

Reverse-geocoded into a real address

Logged silently

🛡️ Deception-based UI

Fake loading screen

Progress bar

Fake payment “success” QR

Zero suspicion raised

📊 Real-Time Admin Dashboard

Dark theme

Auto-refresh every 6 seconds

Shows:

Latest captured images

Address (expand on click)

Google Maps link

Real-time logs

📂 Project Structure
HoneyTrapX/
│
├── index.php          # Deception frontend (camera + GPS)
├── continuous.php     # GPS receiver
├── admin.php          # Admin monitoring dashboard
├── log.txt            # Combined GPS + photo logs
├── uploads/           # Stored photos
├── logo.png           # HoneyTrapX shield logo
└── README.md          # Documentation

🖥️ Installation Guide
1️⃣ Install XAMPP

Start Apache server

2️⃣ Move the project into htdocs
C:\xampp\htdocs\HoneyTrapX

3️⃣ Run on laptop
http://localhost/HoneyTrapX/

4️⃣ Run on phone (same WiFi)
http://192.168.x.x/HoneyTrapX/

5️⃣ Run globally with Cloudflare Tunnel
cloudflared tunnel --url http://localhost/HoneyTrapX


Produces a link like:

https://yourname-edge.trycloudflare.com

6️⃣ Admin Dashboard
http://localhost/HoneyTrapX/admin.php


or

https://your-tunnel-url.trycloudflare.com/admin.php

📝 Log Format
Photo Entry
2025-12-04 12:01:37 | PHOTO | IP: 192.168.1.8 | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ | FILE: uploads/img.jpg

GPS Entry
2025-12-04 12:01:40 | CONTINUOUS | LAT: xx.xxxx | LON: yy.yyyy | ADDRESS: XYZ

🤖 Technology Stack
Component	Technology
Frontend	HTML, CSS, JS
Backend	PHP
Camera API	navigator.mediaDevices
GPS API	Geolocation API
Reverse Geocoding	OpenStreetMap Nominatim
Server	XAMPP Apache
Secure Tunneling	Cloudflare Tunnel
🛡️ Legal & Ethical Notice

HoneyTrapX is intended strictly for:

✔ Academic use
✔ Cybersecurity research
✔ Defensive security demonstrations
✔ Intrusion analysis

Not permitted for:

❌ Real-world surveillance
❌ Targeted tracking
❌ Unlawful data collection
❌ Privacy violations

Use responsibly.

📤 Pushing to GitHub
git init
git add .
git commit -m "HoneyTrapX initial commit"
git remote add origin https://github.com/<username>/HoneyTrapX.git
git branch -M main
git push -u origin main

👤 Author

Debjit Ghosal
HoneyTrapX is developed solely for ethical research and educational purposes.