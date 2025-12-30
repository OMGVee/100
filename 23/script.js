const pressed = [];
const secretCode = 'boom';
window.addEventListener('keyup', (e) => {
    console.log(e.key);
    pressed.push(e.key);
    pressed.splice(-secretCode.length - 1, pressed.length - secretCode.length);
    if (pressed.join('').includes(secretCode)) {
        console.log("HMM, THAT'S A BINGOOOO... HOW EXCITING!😁");
        document.querySelector(".content").textContent = "BOOM💥";
    }
    console.log(pressed);
    
});