// Function to send emails
function validateContactMe() {
    // Get form values
    const fName = document.getElementById("fName");
    const lName = document.getElementById("lName");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const message = document.getElementById("message");
  
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
