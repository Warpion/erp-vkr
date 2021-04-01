function createChart(e) {
    const days = document.querySelectorAll(".chart-values li");
    const tasks = document.querySelectorAll(".chart-bars li");
    const daysArray = [...days];

    let dump = document.getElementById('dump');

    // dump.innerHTML = '00½'.slice(0, -1);

    tasks.forEach(el => {
        const duration = el.dataset.duration.split("-");
        const startDay = duration[0];
        const endDay = duration[1];
        let left = 0,
            width = 0;

        //
        //
        // dump.innerHTML += duration + ' - ';

        if (startDay.slice(-2) === '00') {
            const filteredArray = daysArray.filter(day => day.textContent == startDay.slice(0, -3));
            left = filteredArray[0].offsetLeft;
        } else {
            const filteredArray = daysArray.filter(day => day.textContent == startDay.slice(0, -3));
            left = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth * +startDay.slice(-2) / 60;
        }

        if (endDay.slice(-2) === '00') {
            const filteredArray = daysArray.filter(day => day.textContent == endDay.slice(0, -3));
            //width = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth / 2 - left;
            width = filteredArray[0].offsetLeft - left;
        } else {
            const filteredArray = daysArray.filter(day => day.textContent == endDay.slice(0, -3));
            //width = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth - left;
            width = filteredArray[0].offsetLeft + (filteredArray[0].offsetWidth * +endDay.slice(-2) / 60) - left;
        }

        // apply css
        el.style.left = `${left}px`;
        el.style.width = `${width}px`;
        if (e.type == "load") {
            el.style.backgroundColor = el.dataset.color;
            el.style.opacity = 1;
        }
    });
}

window.addEventListener("load", createChart);
window.addEventListener("resize", createChart);
