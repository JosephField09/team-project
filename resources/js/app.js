import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Function to send emails
function validateContactMe() {
    // Get form values
    const fName = document.getElementById("fName").value;
    const lName = document.getElementById("lName").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const message = document.getElementById("comment").value;
  
    // Validate required fields
    if (
      fName === "" ||
      lName === "" ||
      email === "" ||
      phone === "" ||
      message === ""
    ) {
      alert("Please fill in all required fields.");
      return;
    }
  
    // Regular expression to check if the email is anything@anything.anything
    function validateEmail() {
      var re = /\S+@\S+\.\S+/;
      if (re.test(email) == false) {
        alert("Please enter a valid email address");
        return false;
      }
      return true;
    }
  
    // Regular expression to check if the phone number starts with 0 and is 11 digits long
    function validatePhoneNumber(phone) {
      const phoneRegex = /^0\d{10}$/;
      if (phoneRegex.test(phone) == false) {
        alert("Please enter a valid phone number");
        return false;
      }
      return true;
    }
  
    // Validate email
    function checkMatchingEmails(email, confirmEmail) {
      if (email !== confirmEmail) {
        alert("Emails do not match. Please confirm your email.");
        return false;
      }
      return true;
    }
  
    // Validate contact preference
    function checkPreference(contactPreference) {
      if (contactPreference == "Preference") {
        alert("Please choose your preference for contact");
        return false;
      }
    return true;
    }
  
    if (
      validateEmail(email) &&
      validatePhoneNumber(phone) &&
      checkMatchingEmails(email, confirmEmail) &&
      checkPreference(contactPreference)
    ) {
      
      // Display summary
      const fullName = fName + " " + lName;
      const summaryMessage = `To espressoadmin@gmail.com \nName: ${fullName}\nEmail: ${email}\nPhone: ${phone}\nMessage: ${message}`;
      const confirmation = confirm(`${summaryMessage}\nPress OK to confirm.`);
      // Show confirmation of email sent
      if (confirmation) {
        // Construct the mailto link
        const mailtoLink = `mailto:espressoadmin@gmail.com?subject=${encodeURIComponent(
          subject
        )}&body=${encodeURIComponent(message + "\nFrom " + fullName)}`;
  
        // Open the mail client with prefilled details
        window.location.href = mailtoLink;
      }
    }
}