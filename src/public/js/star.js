document.querySelectorAll('.rating input').forEach((input) => {
  input.addEventListener('change', function () {
      console.log('Selected rating:', this.value);
  });
});
