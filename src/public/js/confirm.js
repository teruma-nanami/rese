document.addEventListener('DOMContentLoaded', function () {
    const reservationDate = document.getElementById('reservation_date');
    const reservationTime = document.getElementById('reservation_time');
    const numberOfPeople = document.getElementById('number_of_people');

    const summaryDate = document.getElementById('summary_date');
    const summaryTime = document.getElementById('summary_time');
    const summaryPeople = document.getElementById('summary_people');

    reservationDate.addEventListener('input', function () {
        summaryDate.textContent = reservationDate.value;
    });

    reservationTime.addEventListener('input', function () {
        summaryTime.textContent = reservationTime.value;
    });

    numberOfPeople.addEventListener('input', function () {
        summaryPeople.textContent = numberOfPeople.value;
    });

    const form = document.querySelector('.form');
    form.addEventListener('submit', function (event) {
        const timeInput = document.getElementById('reservation_time');
        if (timeInput && timeInput.value) {
            // 秒を取り除いて HH:MM 形式に変換
            const timeParts = timeInput.value.split(':');
            if (timeParts.length === 3) {
                timeInput.value = `${timeParts[0]}:${timeParts[1]}`;
            }
        }
    });
});
