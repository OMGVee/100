function setDate() {
    const secondHand = document.querySelector('.second-hand');
    const minuteHand = document.querySelector('.min-hand');
    const hourHand = document.querySelector('.hour-hand');

    const sc = document.querySelector('.sc');
    const mn = document.querySelector('.mn');
    const hr = document.querySelector('.hr');

    const now = new Date();
    const seconds = now.getSeconds();
    sc.innerHTML = seconds;
    // console.log(`seconds:${seconds}`);
    const secondsDegrees = ((seconds / 60) * 360) + 90; /* the 90 
    added is to compensate for the CSS 90 degree rotation 
    defined in the style */
    secondHand.style.transform = `rotate(${secondsDegrees}deg)`;

    const minutes = now.getMinutes();
    mn.innerHTML = minutes;
    // console.log(`minutes:${minutes}`);
    const minutesDegrees = ((minutes / 60) * 360) + 90;
    minuteHand.style.transform = `rotate(${minutesDegrees}deg)`    
    
    const hours = now.getHours();
    hr.innerHTML = hours;
    // console.log(`hours:${hours}`);
    const hoursDegrees = ((hours / 12) * 360) + 90;
    hourHand.style.transform = `rotate(${hoursDegrees}deg)`
}

setInterval(setDate, 1000);