document.addEventListener('DOMContentLoaded', function() {
    const reservationDate = document.getElementById('reservation_date');
    const reservationTime = document.getElementById('reservation_time');
    const numberOfPeople = document.getElementById('number_of_people');
  
    const summaryDate = document.getElementById('summary_date');
    const summaryTime = document.getElementById('summary_time');
    const summaryPeople = document.getElementById('summary_people');
  
    reservationDate.addEventListener('input', function() {
        summaryDate.textContent = reservationDate.value;
    });
  
    reservationTime.addEventListener('input', function() {
        summaryTime.textContent = reservationTime.value;
    });
  
    numberOfPeople.addEventListener('input', function() {
        summaryPeople.textContent = numberOfPeople.value;
    });
});
