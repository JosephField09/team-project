// Listens out for if the contact us form is submitted
document.getElementById('contact-us').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = document.getElementById('contact-us');

    // Gets the values of all the inputs in the form
    let fNameVal = form.fName.value;
    let lNameVal = form.lName.value;
    let emailVal = form.email.value;
    let phoneVal = form.phone.value;
    let messageVal = document.getElementById('uMessage').value;

    // Sets a value called valid to be true, if there is an error with validation then it'll be false
    let valid = true;
    document.getElementById('formError').textContent = "";

    // Checks if the name value is empty
    if (fNameVal == ''){
        document.getElementById('formError').textContent = "Forename is required";
        valid = false;
    }

    // Checks if the surname value is empty
    if (lNameVal == ''){
        document.getElementById('formError').textContent = "Surname is required";
        valid = false;
    }

    // Checks if the email is empty or if it matches the valid email pattern
    const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailVal == '' || !validEmail.test(emailVal)){
        document.getElementById('formError').textContent = "A valid email is required";
        valid = false;
    }

    // Checks if the phone number is empty or is a valid phone number
    const validPhone = /^[0-9]{10,15}$/;
    if (phoneVal == '' || !validPhone.test(phoneVal)){
        document.getElementById('formError').textContent = "A valid phone number is required";
        valid = false;
    }

    // Checks it the message box is empty
    if(messageVal == ''){
        document.getElementById('formError').textContent = "A message is required";
        valid = false;
    }

    // If valid is still true after all those checks then it will ask the user to confirm the message to be sent
    if (valid == true){
         if (confirm("To support@espresso.com"+"\nForname: "+fNameVal+"\nSurname: "+lNameVal+
            "\nEmail: "+emailVal+"\nPhone number: "+phoneVal+"\nMessage: "+messageVal
        ) == true){
            alert("Message sent!");
            window.location.reload();
        } else {
            document.getElementById('formError').textContent = "Message cancelled";
        }
    }
});