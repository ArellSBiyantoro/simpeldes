// Import Firebase SDKs
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-analytics.js";
import { getDatabase, ref, set, get, onValue } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-database.js";

// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBwwslYlUQUWaDag3kiCbDMZsxmG-z393c",
  authDomain: "water-level-sensor-4919d.firebaseapp.com",
  databaseURL: "https://water-level-sensor-4919d-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "water-level-sensor-4919d",
  storageBucket: "water-level-sensor-4919d.appspot.com",
  messagingSenderId: "1051915538816",
  appId: "1:1051915538816:web:f48ba6cf8969d268357165",
  measurementId: "G-0YVCMKR35C"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const database = getDatabase(app);
const analytics = getAnalytics(app);

// Firebase Realtime Database references
const kelembapanRef = ref(database, '/kelembapan');
const ketinggianRef = ref(database, '/ketinggian');
const pintu1Ref = ref(database, '/pintu1');
const pintu2Ref = ref(database, '/pintu2');
const kontrolManualRef = ref(database, '/kontrolManual');

// Referensi ke elemen HTML
const kelembapanCircle = document.getElementById('kelembapan-circle');
const kelembapanText = document.getElementById('kelembapan-circle-text');
const kelembapanSpan = document.getElementById('kelembapan');
const ketinggianCircle = document.getElementById('ketinggian-circle');
const ketinggianText = document.getElementById('ketinggian-circle-text');
const ketinggianSpan = document.getElementById('ketinggian');
const pintu1Button = document.getElementById('pintu1-button');
const pintu2Button = document.getElementById('pintu2-button');
const kontrolManualButton = document.getElementById('kontrol-manual-button');

// Global state variables
let kontrolManualAktif = false;
let timeoutId = null; // Timeout control

// Update UI with data from Firebase
function updateUI(data) {
    kelembapanSpan.textContent = data.kelembapan !== undefined ? data.kelembapan : '-';
    ketinggianSpan.textContent = data.ketinggian !== undefined ? data.ketinggian : '-';
    updateCircle('kelembapan-circle', data.kelembapan, 'kelembapan-circle-text');
    updateCircle('ketinggian-circle', data.ketinggian, 'ketinggian-circle-text');
    document.getElementById('pintu1-status').textContent = data.pintu1 !== undefined ? data.pintu1 : '-';
    document.getElementById('pintu2-status').textContent = data.pintu2 !== undefined ? data.pintu2 : '-';
}

// Update progress circles
function updateCircle(circleId, value, textId) {
    const circle = document.getElementById(circleId);
    const text = document.getElementById(textId);
    if (value !== undefined) {
        const percentage = Math.min(100, Math.max(0, value));
        circle.style.setProperty('--progress', percentage);
        text.textContent = `${percentage}%`;
    } else {
        circle.style.setProperty('--progress', 0);
        text.textContent = '-';
    }
}

// Fetch data from Firebase and update UI
function updateData() {
    onValue(ref(database, '/'), (snapshot) => {
        const data = snapshot.val();
        updateUI(data);
    });
}

// Toggle the state of a gate (pintu)
function togglePintu(pintuRef) {
    const pintuStatusRef = ref(database, pintuRef);
    get(pintuStatusRef).then((snapshot) => {
        const currentStatus = snapshot.val();
        const newStatus = currentStatus === 'aktif' ? 'nonaktif' : 'aktif';
        set(pintuStatusRef, newStatus).catch((error) => {
            console.error(`Gagal mengubah status ${pintuRef}:`, error);
        });
    });
}

// Toggle manual control
function toggleKontrolManual() {
    if (kontrolManualAktif) {
        set(kontrolManualRef, 'nonaktif').then(() => {
            clearTimeout(timeoutId);
            togglePintuButtons(false);
        }).catch(console.error);
    } else {
        set(kontrolManualRef, 'aktif').then(() => {
            togglePintuButtons(true);
            timeoutId = setTimeout(() => {
                set(kontrolManualRef, 'nonaktif').then(() => {
                    togglePintuButtons(false);
                }).catch(console.error);
            }, 60 * 1000); // 1-minute timeout
        }).catch(console.error);
    }
}

// Display or hide gate control buttons
function togglePintuButtons(aktif) {
    pintu1Button.style.display = aktif ? 'inline-block' : 'none';
    pintu2Button.style.display = aktif ? 'inline-block' : 'none';
}

// Event listeners
pintu1Button.addEventListener('click', () => togglePintu('/pintu1'));
pintu2Button.addEventListener('click', () => togglePintu('/pintu2'));
kontrolManualButton.addEventListener('click', toggleKontrolManual);

// Fetch data on page load
updateData();
