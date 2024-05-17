// STARTING CONTACT PAGE

const form = document.querySelector("#contact-form");

if(location.pathname.includes("/index.") && form) {

    Object.keys(searchParams).forEach(param => {
        const element = form.querySelector(`[name="${param}"]`);
        if(element && element.tagName.toLowerCase() === "select") [...element.children].forEach(children => {
            if(children.value === searchParams[param]) children.selected = true;
        });
    });
    
    if(searchParams.flag && searchParams.message) {

        const alert = document.createElement("div");
        alert.setAttribute("class", "alert alert-dismissible fade show");
        alert.setAttribute("role", "alert");

        alert.innerHTML = `
            ${searchParams.message}
            <button type="button" class="btn position-absolute top-0 bottom-0 end-0" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        `;

        switch(searchParams.flag) {
            case "primary":
                alert.classList.add("alert-primary");
                break;
            case "secondary":
                alert.classList.add("alert-secondary");
                break;
            case "success":
                alert.classList.add("alert-success");
                break;
            case "danger":
                alert.classList.add("alert-danger");
                break;
            case "warning":
                alert.classList.add("alert-warning");
                break;
            case "info":
                alert.classList.add("alert-info");
                break;
            case "light":
                alert.classList.add("alert-light");
                break;
            case "dark":
                alert.classList.add("alert-dark");
                break;
            default:
                alert.classList.add("alert-light");
                break;
        }

        alert.querySelector('[data-bs-dismiss="alert"]').addEventListener("click", e=> history.replaceState(null, null, window.location.pathname));

        form.parentNode.insertBefore(alert, form);

    };
    
}

// ENDING CONTACT PAGE