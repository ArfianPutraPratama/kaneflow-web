// resources/js/firebase.js
import { initializeApp } from 'firebase/app';
import { getAuth, GoogleAuthProvider, signInWithPopup } from 'firebase/auth';

const firebaseConfig = {
    apiKey: import.meta.env.VITE_FIREBASE_API_KEY || "AIzaSyDCLP5K_w07kRLJTN-cJkpMzUTym5V1beI",
    authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN || "kaneflow-9055b.firebaseapp.com",
    projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID || "kaneflow-9055b.firebasestorage.app",
    storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET || "kaneflow-9055b.firebasestorage.app",
    messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID || "341595554679",
    appId: import.meta.env.VITE_FIREBASE_APP_ID || "1:341595554679:web:ca8afb2095f51bec11d772"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

export { auth, provider, signInWithPopup };
