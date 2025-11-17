function setCurrentDate() {
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    var year = today.getFullYear();

    var currentDate = year + '-' + month + '-' + day;
    document.getElementById('currentDate').value = currentDate;
}

// Call the function to set the current date when the page loads
window.onload = setCurrentDate;


function validateForm(event) {
    const borrowID = document.getElementById('borrowid').value;
    const bookID = document.getElementById('bookid').value;
    const memberID = document.getElementById('memberid').value;

    // Regular Expressions for validation
    const borrowIDPattern = /^BR\d{3}$/;
    const bookIDPattern = /^B\d{3}$/;
    const memberIDPattern = /^M\d{3}$/;

    // Validate Borrow ID
    if (!borrowIDPattern.test(borrowID)) {
        alert('Invalid Borrow ID format. It should be in the format BR<MEMBER_ID> (e.g., BR001).');
        event.preventDefault();
        return false;
    }

    // Validate Book ID
    if (!bookIDPattern.test(bookID)) {
        alert('Invalid Book ID format. It should be in the format B<BOOK_ID> (e.g., B001).');
        event.preventDefault();
        return false;
    }

    // Validate Member ID
    if (!memberIDPattern.test(memberID)) {
        alert('Invalid Member ID format. It should be in the format M<MEMBER_ID> (e.g., M001).');
        event.preventDefault();
        return false;
    }

    // Set the modified date to the current system date
    document.getElementById('currentDate').value = new Date().toISOString().slice(0, 10);

    return true; // Allow form submission if validation passes
}

// Function to update borrow status
document.addEventListener('DOMContentLoaded', function() {
    const borrowStatus = document.getElementById('borrow-status');

    borrowStatus.addEventListener('change', function() {
        if (borrowStatus.value === 'borrowed') {
            alert('The book has been borrowed.');
        } else if (borrowStatus.value === 'available') {
            alert('The book is available.');
        }
    });
});



// Attach event listeners when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('borrowButton').addEventListener('click', validateForm);
    document.getElementById('borrow-status').addEventListener('change', updateBorrowStatus);
});