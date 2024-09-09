// Import Firebase SDKs
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-analytics.js";
import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-database.js";

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

// Firebase Realtime Database reference
const dataRef = ref(database, '/');

// Update UI with data from Firebase
function updateUI(data) {
    document.getElementById('kelembapan').textContent = data.kelembapan !== undefined ? data.kelembapan : '-';
    document.getElementById('ketinggian').textContent = data.ketinggian !== undefined ? data.ketinggian : '-';
    updateCircle('kelembapan-circle', data.kelembapan, 'kelembapan-circle-text');
    updateCircle('ketinggian-circle', data.ketinggian, 'ketinggian-circle-text');
    document.getElementById('pintu1').textContent = data.pintu1 !== undefined ? data.pintu1 : '-';
    document.getElementById('pintu2').textContent = data.pintu2 !== undefined ? data.pintu2 : '-';
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

// Listen for changes in Firebase data
onValue(dataRef, (snapshot) => {
    const data = snapshot.val();
    updateUI(data);
});
