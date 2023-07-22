let menuToggler = document.querySelector(".menu-toggler");
let menubar = document.querySelector(".menubar");
let menu = document.querySelector(".menu");
let userMenuButton = document.querySelector(".header-menu_mobile-version-menu-trigger");
let userMenu = document.querySelector(".header-menu");
let userMenuSubstrate = document.querySelector(".header-menu_modal-substrate");

// window.onresize = () => {
//     if (window.innerWidth <= 480) {
//         console.log("<= 480");
//     }
//     if (window.innerWidth > 480 && window.innerWidth <= 768) {
//         console.log(" < 480 && <= 768");
//     }
//     if (window.innerWidth > 480 && window.innerWidth <= 768) {
//         console.log(" < 480 && <= 768");
//     }
// };

const tabletMenuHandler = () => {
    event.stopPropagation();
    event.stopImmediatePropagation();
};

// const bodyCleaner = () => {
//     if (menuToggler.style.visibility === "hidden" && document.body.style.opacity === "0.2" )  {
//         menuToggler.style.visibility = "visible";
//         document.body.style.opacity = "1";
//         document.body.style.position = "initial";
//     };
// };

const showHideUserMenu = () => {
    event.stopPropagation();
    event.stopImmediatePropagation();
    userMenu.classList.toggle("header-menu_mobile-visualised");
    userMenuSubstrate.classList.toggle("header-menu_modal-substrate--visualised");
    document.body.style.position = "fixed";
    document.body.addEventListener("click", () => {
        if(userMenu.classList.contains("header-menu_mobile-visualised")) {
            userMenu.classList.remove("header-menu_mobile-visualised");
            userMenuSubstrate.classList.remove("header-menu_modal-substrate--visualised");
            document.body.style.position = "initial";
        }
    });
}

const collapseAllmenuItems = () => {

}

let subMenuVisibilityController = () => {
    let clickedMenuElement = event.target.parentNode.querySelector(".menu-link");
    // clickedMenuElement.classList.toggle("menu-link--selected");
    let clickedSubMenu = event.target.parentNode.querySelector(".submenu");
    if (event.target.parentNode.classList.contains("menu-item--with-submenu")) {
        clickedSubMenu.classList.toggle("submenu-expanded");
    }
}

const initializeTabletMenu = () => {
    document.body.style.opacity ="1";
    menuToggler.style.visibility = "visible";
}


let = initializeMenuScripts = () => {
    // menu.addEventListener("click", slectMenuItemAzActive); // creatres bug in PHP
    menu.addEventListener("click", subMenuVisibilityController)
    if (window.innerWidth <= 480) {
        menuToggler.addEventListener("click", tabletMenuHandler);
        userMenuButton.addEventListener("click", showHideUserMenu);
    }
    if (window.innerWidth > 480 && window.innerWidth <= 768) {
        menuToggler.addEventListener("click", tabletMenuHandler);
        userMenu.classList.remove("header-menu_mobile-visualised");
        menu.style.backgroundColor = "#2D2D2D";
        userMenuSubstrate.classList.remove("header-menu_modal-substrate--visualised");
        initializeTabletMenu();
    }
    if (window.innerWidth > 768) {
        menuToggler.removeEventListener("click", tabletMenuHandler);
        userMenuSubstrate.classList.remove("header-menu_modal-substrate--visualised");
    }
}

let clearMenuSelections = ()  => {
    let itemsWithSubmenu = document.querySelectorAll(".menu-item--with-submenu");
    itemsWithSubmenu.forEach((item) => {
        // item.classList.remove("menu-link--selected"); // creatres bug in PHP
    });
}


// FORM HANDLER

let formData = document?.querySelector(".formdata");
let phoneNum = formData?.querySelector("#phone");
let ePasswordField = formData?.querySelector("#password");
let submitButton = formData?.querySelector("#submit");
let codeButton = formData?.querySelector("#code");

let errors = {};

let formatNumber_ru = (evt) => {
    let num = evt.target.value;
    switch (true) {
        case num.length > 14:
        {
            console.log("length > 14");
            let numArr = num.split("", 14);
            evt.target.value = numArr.join("");
            break;
        }
        case num[0] !== "+" &&
            num[1] !== "7" &&
            num[2] !== "(" &&
            num.length <= 3:
        {
            let numArr = num.split("", 14);
            numArr.unshift("+7(");
            evt.target.value = numArr.join("");
            break;
        }
        case num[0] !== "+":
        { 
            let numArr = num.split("", 14);
            numArr[0] = ("+");
            evt.target.value = numArr.join("");
            break;
        }
        case num[1] !== "7":
        { 
            let numArr = num.split("", 14);
            numArr[1] = ("7");
            evt.target.value = numArr.join("");
            break;
        }
        case num[2] !== "(":
        { 
            let numArr = num.split("", 14);
            numArr[2] = ("(");
            evt.target.value = numArr.join("");
            break;
        }
        case num[6] !== ")" && num.length > 6:
        { 
            let numArr = num.split("", 14);
            if(numArr[3] === ")" || numArr[4] === ")" || numArr[5] === ")") {
                return;
            } else {
                let temp = numArr[6];
                numArr[6] = (")");
                numArr[7] = temp;
                evt.target.value = numArr.join("");
                break;
            }
        }

    }
};

let textInputed = (trgt) => {
    return trgt.value.length > 0;
};

let isPhoneCorrect = (trgt) => {
    let phoneNum = trgt.value;
    return (!!phoneNum.match(/\+\d\([0-9]{3}\)[0-9]{7}/) && trgt.value.length === 14);
};

let isPasswordStrong = (trgt) => {
    return trgt.value.length >= 8;
};

let isCodeLonEnought = (trgt) => {
    return trgt.value.length === 4;
};

let setFocusEffects = (trgt) => {
    trgt.style.backgroundColor = "#e6ffff";
};

let setBlurEffects = (trgt) => {
    trgt.style.backgroundColor = "#ffffff"; 
    delete errors[trgt.name]; 
    Object.keys(errors).length === 0 ? 
    submitButton.disabled = false : 
    errors;
}

let removeBlurEffects = (trgt) => {
    trgt.style.backgroundColor = "#ffcccc"; 
    errors[trgt.name] = true;
}

let manageBlurEvffects = (trgt) => {

    return textInputed(trgt) ? 
    (() => { setBlurEffects(trgt); return true; })() : 
    (() => { removeBlurEffects(trgt); return false; })() ;
};


let checkPassword = (trgt) => {
    return isPasswordStrong(trgt) ? 
    (() => { setBlurEffects(trgt); return true; })()  : 
    (() => { removeBlurEffects(trgt); return false; })() ;
};

let checkPhone = (trgt) => {
    return isPhoneCorrect(trgt) ? 
    (() => { setBlurEffects(trgt); return true; })()  : 
    (() => { removeBlurEffects(trgt); return false; })() ;
};

let checkCode = (trgt) => {
    return isCodeLonEnought(trgt) ? 
    (() => { setBlurEffects(trgt); return true; })()  : 
    (() => { removeBlurEffects(trgt); return false; })() ;
};


let checkAllFields = (evt) => {

    if ( phoneNum ) {
        checkPhone(phoneNum) ? event.stopImmediatePropagation() : evt.preventDefault();
    }
    if ( ePasswordField ) {
        checkPassword(ePasswordField) ? event.stopImmediatePropagation() : evt.preventDefault();
    }
    if ( codeButton ) {
        checkCode(codeButton) ? event.stopImmediatePropagation() : evt.preventDefault();
    }
}

class FormVerifier {
    handleEvent(event) {
        let method = 'on' + event.type[0].toUpperCase() + event.type.slice(1);
        this[method](event);
    }

    onClick() {
        checkAllFields(event);
    }

    onFocus() {
        setFocusEffects(event.target);
    }

    // onMouseenter() {
    //     checkAllFields(event);
    // }

    onBlur() {
        event.target === ePasswordField ? checkPassword(event.target) : false;
        event.target === phoneNum ? checkPhone(event.target) : false;
        event.target === codeButton ? checkCode(event.target) : false;
        // event.target === emailField ? checkEmail(event) : false;
    }
    onInput() {
        console.log(event.target === ePasswordField);
        console.log(event.target === phoneNum);
        console.log(event.target === codeButton);
        event.target === phoneNum ? formatNumber_ru(event) : false;
        manageBlurEvffects(event.target);
        // event.target === ePasswordField ? checkPassword(event) : false;
    }
  }

const formVerifier = new FormVerifier;

    phoneNum?.addEventListener("focus", formVerifier);
    phoneNum?.addEventListener("blur", formVerifier);
    phoneNum?.addEventListener("input", formVerifier);

    ePasswordField?.addEventListener("focus", formVerifier);
    ePasswordField?.addEventListener("blur", formVerifier);
    ePasswordField?.addEventListener("input", formVerifier);

    codeButton?.addEventListener("focus", formVerifier);
    codeButton?.addEventListener("blur", formVerifier);
    codeButton?.addEventListener("input", formVerifier);

    submitButton?.addEventListener("click", formVerifier);
    // submitButton?.addEventListener("mouseenter", formVerifier);

// END OF FORMHANDLER

window.onresize = () => {
    initializeMenuScripts();
};

window.addEventListener("load", function(event) {
    clearMenuSelections();
    initializeMenuScripts();
},false);