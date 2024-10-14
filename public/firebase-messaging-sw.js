<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyC18LPnyqYKp9pgWfLMpFalSwnVSpDC1Kc",
    authDomain: "smdgapecommerce.firebaseapp.com",
    projectId: "smdgapecommerce",
    storageBucket: "smdgapecommerce.appspot.com",
    messagingSenderId: "1087750634499",
    appId: "1:1087750634499:web:f8dfdd8f9c1dd9abd96236",
    measurementId: "G-D83Q7KG82T"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
