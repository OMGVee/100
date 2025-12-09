const checkboxes = document.querySelectorAll('.inbox input[type="checkbox"]');
const size = checkboxes.length;
//console.log(size);
//console.log(checkboxes);
let lastChecked;

function handleCheck(e) {
    console.log(e);
    let inBetween = false;
    if (e.shiftKey && this.checked) {
        checkboxes.forEach((checkbox) => {
            console.log(checkbox);
            if (checkbox === this || checkbox == lastChecked) {
                inBetween = !inBetween;
                console.log("this:" + this + " inBetween:" + inBetween);
            }

            if (inBetween) {
                checkbox.checked = true;
            }
        });
    }
    lastChecked = this;
}

checkboxes.forEach((checkbox) =>
    checkbox.addEventListener("click", handleCheck)
);
