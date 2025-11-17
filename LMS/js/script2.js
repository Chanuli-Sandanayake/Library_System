const bookForm = document.getElementById('book-form');
const bookList = document.getElementById('book-list');
const registerBtn = document.getElementById('register-btn');

// Book ID validation (regular expression)
const bookIDRegex = /^B\d{3}$/;  // Must start with B followed by 3 digits

bookForm.addEventListener('submit', function(event) {
  const bookID = document.getElementById('book-id').value;
  if (!bookIDRegex.test(bookID)) {
    alert('Invalid Book ID format! Must be B followed by 3 digits (e.g., B001)');
    event.preventDefault();  // Prevent form submission
  }
});

bookList.innerHTML = `<tr>
  <th>Book ID</th>
  <th>Book Name</th>
  <th>Book Category</th>
  <th>Actions</th>  </tr>`