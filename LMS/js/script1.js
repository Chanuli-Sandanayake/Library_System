document.addEventListener('DOMContentLoaded', () => {
    const memberIDInput = document.querySelector('#d1 + input');
    const emailInput = document.querySelector('#d5 + input');
    const form = document.getElementById('form');
    
    const idError = document.getElementById('member_id_error');
    const emailError = document.getElementById('email_error');
    
    form.addEventListener('submit', (e) => {
        let isValid = true;
        const emailCheck = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const memberIDCheck = /^M\d{3}$/;
    
        if (!memberIDInput.value.match(memberIDCheck)) {
            e.preventDefault();
            idError.innerHTML = "ID should be in the 'M<MEMBER_ID>' format only (e.g., M001)";
            isValid = false;
        } else {
            idError.innerHTML = "";
        }
    
        if (!emailInput.value.match(emailCheck)) {
            e.preventDefault();
            emailError.innerHTML = "Email is in invalid format";
            isValid = false;
        } else {
            emailError.innerHTML = "";
        }
    
        if (!isValid) {
            return false;
        }
    });
});
