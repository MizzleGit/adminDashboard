const mediaMax750 = window.matchMedia("(max-width:705px)");

// If "Suivi votre demande" (Login) is selected
function loginSelected() {


    // Variables
    let loginForm = document.getElementById("login-form");
    let loginButton = document.getElementById("login-selected");
    let signupButton = document.getElementById("signup-selected");
    let rightDiv = document.getElementById('login-selected-right-div');

    // Mobile-only
    let LoginBack = document.getElementById("login-back");
    let signupDiv = document.getElementsByClassName("signup-right")[0];
    let loginDiv = document.getElementsByClassName("login-left")[0];
    let customButtons = document.getElementsByClassName("custom-button")[0];

    // For mobile (Work in progress)
    if (mediaMax750.matches) {
        // Make login take up 100% of the screen
        signupDiv.style.display = "none";
        loginDiv.style.height = "100vh";

        // Make login elements appear
        loginForm.style.display = "flex";
        loginForm.style.opacity = 1;
        LoginBack.style.display = "flex";

        // Make "Suivi votre demande" and "S'inscrire pour un stage" buttons disappear
        signupButton.style.display = "none";
        loginButton.style.display = "none";
    }


    // For desktop
    else {

        // Making login illustration appear from the right
        rightDiv.style.opacity = "1";
        rightDiv.style.transition = 'right 1s cubic-bezier(0.5, 1, 0.5, 1)';
        rightDiv.style.right = '0vw';

        // Making "Suivi votre demande" button disappear
        loginButton.style.display = "none";
        loginButton.style.opacity = 0;

        // Making "S'inscrire pour un stage" button disappear
        signupButton.style.display = "none";
        signupButton.style.opacity = 0;

        // Making Login form appear with opacity
        loginForm.style.display = "flex";
        loginForm.style.transition = 'opacity 1s ease';
        setTimeout(() => {
            loginForm.style.opacity = 1;
        }, 1);


    } // End of else
} // End of function loginSelected

function signupSelected() {
    // Variables
    let leftDiv = document.getElementById("signup-selected-left-div");
    let signupForm = document.getElementById("signup-form");
    let signupButton = document.getElementById("signup-selected");
    let loginButton = document.getElementById("login-selected");

    // Mobile-only
    let signupBack = document.getElementById("signup-back");
    let signupDiv = document.getElementsByClassName("signup-right")[0];
    let loginDiv = document.getElementsByClassName("login-left")[0];


    if (mediaMax750.matches) {
        // Make signup take up 100% of the screen
        loginDiv.style.display = "none";
        signupDiv.style.height = "100vh";

        // Make signup elements appear
        signupForm.style.display = "flex";
        signupForm.style.opacity = 1;
        signupBack.style.display = "flex";

        // Make "Suivi votre demande" and "S'inscrire pour un stage" buttons disappear
        signupButton.style.display = "none";
        loginButton.style.display = "none";
    }
    else {

         // Making signup illustration appear from the left
        leftDiv.style.opacity = "1";
        leftDiv.style.transition = 'left 1s cubic-bezier(0.5, 1, 0.5, 1)';
        leftDiv.style.left = '0vw';    

        // Making "S'inscrire pour un stage" button disappear
        signupButton.style.display = "none";
        signupButton.style.opacity = 0;

        // Making "Suivi votre demande" button disappear
        loginButton.style.display = "none";
        loginButton.style.opacity = 0;

        // Making Signup form appear with opacity
        signupForm.style.display = "flex";
        signupForm.style.transition = 'opacity 1s ease';
        setTimeout(() =>{
            signupForm.style.opacity = 1;
        }, 1);


    } // End of else
} // End of function signupSelected

function switchBack() {

    // Variables
    let loginForm = document.getElementById("login-form");
    let signupForm = document.getElementById("signup-form");
    let rightDiv = document.getElementById('login-selected-right-div');
    let leftDiv = document.getElementById('signup-selected-left-div');
    let loginButton = document.getElementById("login-selected");
    let signupButton = document.getElementById("signup-selected");

    // Mobile-only
    let LoginBack = document.getElementById("login-back");
    let signupBack = document.getElementById("signup-back");
    let signupDiv = document.getElementsByClassName("signup-right")[0];
    let loginDiv = document.getElementsByClassName("login-left")[0];

    if (mediaMax750.matches){

        // Make back buttons disappear
        LoginBack.style.display = "none";
        signupBack.style.display = "none";

        // Make forms disappear
        signupForm.style.opacity = "0";
        signupForm.style.display = "none";

        loginForm.style.opacity = "0";
        loginForm.style.display = "none";

        // Set the measures back to normal
        signupDiv.style.height = "50vh";
        loginDiv.style.height = "50vh";

        // Make divs appear
        signupDiv.style.opacity = "1";
        signupDiv.style.display = "flex";

        loginDiv.style.opacity = "1";
        loginDiv.style.display = "flex";

        // Make buttons appear
        loginButton.style.opacity = "1";
        loginButton.style.display = "flex";

        signupButton.style.opacity = "1";
        signupButton.style.display = "flex";

    }
    else{
        // Forms opacity to 0
        loginForm.style.transition = 'opacity 0.5s ease';
        loginForm.style.opacity = 0;
        //
        signupForm.style.transition = 'opacity 0.5s ease';
        signupForm.style.opacity = 0;

        // Move illustrations back 
        rightDiv.style.transition = 'right 1s cubic-bezier(0.5, 1, 0.5, 1)';
        rightDiv.style.right = '-50vw';
        // 
        leftDiv.style.transition = 'left 1s cubic-bezier(0.5, 1, 0.5, 1)';
        leftDiv.style.left = '-50vw';
        // 

        setTimeout(() => {

            // Set displays away
            loginForm.style.display = "none";
            signupForm.style.display = "none";


            // Change button displays to flex and add opacity transition
            loginButton.style.display = 'flex';
            loginButton.style.transition = 'opacity 0.5s ease';
            //
            signupButton.style.display = 'flex';
            signupButton.style.transition = 'opacity 0.5s ease';


            // Make buttons appear and divs disappear after moving away from the screen
            setTimeout(() => {

                loginButton.style.opacity = '1';
                signupButton.style.opacity = '1';

                leftDiv.style.opacity = "0";
                rightDiv.style.opacity = "0";

            }, 500);
        }, 500);
    }
    

}