// Function to get URL parameters
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Check for error parameter in URL
const stat = getUrlParameter('stat');

if (stat) {
    let message = '';
    let title = 'Error';
    let icon = 'error';
    switch (stat) {
        case 'invaliduserid':
            message = 'User ID must be between U001 and U999.';
            break;
        case 'invalidusername':
            message = 'Invalid username. Only letters and numbers are allowed.';
            break;
        case 'invalidemail':
            message = 'Invalid email address.';
            break;
        case 'usernametaken':
            message = 'Username or email already taken.';
            break;
        case 'invalidpwd':
            message = 'password must be more than 8 characters.';
            break;
        case 'stmtfailed':
            message = 'Something went wrong. Please try again.';
            break;
        case 'Already_Exists':
            message = 'Account Already Exists.';
            break;
        case 'Email_Exists':
            message = 'Email Already Exists.';
            break;
        case 'none':
            title = 'Account Creation Saved Successfully.';
            message = 'Welcome to the Library management system';
            icon = 'success';
            break;
        case 'Created':
            title = 'User Added Successfully.';
            icon = 'success';
            break;
        case 'Invalid_user_id_format':
            title = 'Invalid User Id Format';
            break;
        case 'User_id_already_exists':
            title = 'User Id Already Exists';
            break;
        case 'nouser':
            message = 'User does not exist.';
            break;
        case 'user_not_found':
            message = 'User Not Found';
            break;
        case 'wrongpwd':
            message = 'Wrong password.';
            break;
        case 'password_updated':
            title = 'Password Updated Successfully.';
            message = 'You Can Log Now';
            icon = 'success';
            break;
        case 'success':
            title = 'Login successfully';
            message = 'Welcome Back';
            icon = 'success';
            break;
        case 'logout':
            title = 'You have been logged out successfully.';
            message = 'See You Again.';
            icon = 'success';
            break;
        case 'Deleted':
            title = 'User Account Deleted Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'Member_Details_Deleted':
            title = 'Member Details Deleted Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'Book_Deleted':
            title = 'Book Details Deleted Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'Book_ID_Already_Exists':
            title = 'Book ID Already Exists';
            message = '';
            break;
        case 'Invalid_book_id_format':
            title = 'Invalid Book Id Format';
            message = '';
            break;

        case 'Updated_successfully':
            title = 'User Account Updated Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'Book_Reg_Succsseful':
            title = 'Book Details Added Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'registration_successful':
            title = 'Member Details Added Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'Invalid_member_id_format':
            title = 'Invalid Member Id Format';
            message = '';
            break;
        case 'Updated_member_successfully':
            title = 'Member Details Updated Successfully.';
            message = '';
            icon = 'success';
            break;
        case 'Member_id_already_exists':
            title = 'Member Id Already Exists';
            message = '';
            break;
        case 'Record_updated_successfully':
            title = 'Book Borrow Record Updated Successfully';
            message = '';
            icon = 'success';
            break;
        case 'Error_updating_record':
            title = 'Error Updating Record';
            message = '';
        case 'Book_ID_does_not_exist':
            title = 'Book ID Does Not Exist';
            message = '';
            break;
        case 'Book_already_borrowed':
            title = 'Book Already Borrowed';
            message = 'If You Want To Modify AS "Available". Try Using "View Borrow detail" section and Modify as ""Available".';
            icon = 'warning';
            break;
        case 'Member_ID_does_not_exist':
            title = 'Member ID Does Not Exist';
            break;
        case 'Record_added_successfully':
            title = 'Book Borrow Details Added Successfully';
            message = '';
            icon = 'success';
            break;
        case 'Borrow_record_Deleted':
            title = 'Book Borrow Record Deleted Successfully';
            message = '';
            icon = 'success';
            break;
        case 'Error_adding_record':
            title = 'Error Adding Record';
            break;
        case 'Invalid_borrow_id_format':
            title = 'Invalid Borrow Id Format';
            break;
        case 'borrow_details_updated_successfully':
            title = 'Borrow Details Updated Successfully';
            message = '';
            icon = 'success';
            break;
        case 'Borrow_ID_Already_Exists':
            title = 'Borrow ID Already Exists';
            break;
        case 'Email_or_member_id_Exists':
            title = 'Email Or Member Id Exists';
            break;
        default:none
            
        
    }
    swal(title, message, icon);
}
