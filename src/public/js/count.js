document.addEventListener('DOMContentLoaded', function() {
  const textarea = document.getElementById('comment');
  const charCount = document.getElementById('charCount');

  if (textarea && charCount) {
      textarea.addEventListener('input', function () {
          const count = this.value.length;
          charCount.textContent = count + '/400（最高文字数）';
      });
  }
});
