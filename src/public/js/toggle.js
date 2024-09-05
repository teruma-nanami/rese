document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.favorite-button').forEach(button => {
      button.addEventListener('click', function(event) {
          event.preventDefault();
          const form = this.closest('form');
          fetch(form.action, {
              method: form.method,
              body: new FormData(form),
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
          }).then(response => {
              if (response.ok) {
                  return response.text();
              }
              throw new Error('Network response was not ok.');
          }).then(text => {
              if (text.includes('added')) {
                  this.classList.add('btn-danger');
                  this.classList.remove('btn-outline-danger');
              } else if (text.includes('removed')) {
                  this.classList.add('btn-outline-danger');
                  this.classList.remove('btn-danger');
              }
          }).catch(error => {
              console.error('There was a problem with the fetch operation:', error);
          });
      });
  });
});
