// let quizInformation = document.querySelectorAll('.quiz__info');
// let navbare = document.querySelector(".navbar");
// let barsBtne = navbare != null ? navbare.querySelector(".bars") : null;
// barsBtne != null ?
//   barsBtne.addEventListener("click", () => {
//     navbare.classList.toggle("active");
//   }) : null
document.querySelector('.back__page') != null ? document.querySelector('.back__page').onclick = () => document.querySelector('.quiz__information').classList.remove('active') : null;
document.querySelectorAll('.quiz__name') != null ? document.querySelectorAll('.quiz__name').forEach(item => item.onclick = function () {
  document.querySelector('.quiz__information').classList.add('active');
  var idFormData = new FormData();
  idFormData.append("id", item.id);
  idFormData.append("email", item.getAttribute('data-email'));
  fetch('functions/getsubjectquizess.php', {
    method: 'POST',
    body: idFormData
  })
    .then(res => res.text())
    .then(data => {
      document.querySelector('.quizzes').innerHTML = data;
      setTimeout(() => {
        document.querySelectorAll('.quiz__info').forEach(item => item.onclick = () => location.href = `quizpage.php?quizId=${item.id}&subjectId=${item.getAttribute('data-subject')}`)
      })
    }, 10);
}) : null

function errorMassege(message, color) {
  document.querySelector('.error__message').classList.add('active');
  document.querySelector('.error__message').style.background = color;
  document.querySelector('.error__message').textContent = message;
  setTimeout(() => {
    document.querySelector('.error__message').classList.remove('active');
  }, 5000);
}

function editAcc(accId, file, file2) {
  document.querySelector('.form__container.edit').classList.add('active');
  document.querySelector('.form__container.edit .close__form').onclick = () => document.querySelector('.form__container.edit').classList.remove('active');
  var idForm = new FormData();
  idForm.append('id', accId);
  fetchData(`./functions/${file}`, idForm).then(res => res.json()).then(data => {
    document.querySelector('.form__container.edit form input[name=name]').value = data.username;
    document.querySelector('.form__container.edit form input[name=number]').value = data.phonenumber;
    document.querySelector('.form__container.edit form input[name=address]').value = data.address;
    document.querySelector('.form__container.edit form select[name=gender]').value = data.gender;
  })
  document.querySelector('.form__container.edit form').onsubmit = (e) => {
    e.preventDefault();
    var detailsForm = new FormData(document.querySelector('.form__container.edit form'));
    detailsForm.append('id', accId);
    fetchData(`./functions/${file2}`, detailsForm).then(res => res.text()).then(data => {
      if (data != 'Added') {
        errorMassege(data, 'red');
      } else {
        errorMassege('Added', 'green');
        location.reload();
      }
    })
  }
}


function deleteAcc(accId, file2) {
  var detailsForm = new FormData();
  detailsForm.append('id', accId);
  postRequest(file2, detailsForm);
}

function deleteSubjectfromTeacher(id, email, file) {
  var detailsForm = new FormData();
  detailsForm.append('id', id);
  detailsForm.append('email', email);
  postRequest(file, detailsForm);
  console.log(file)
}

function postRequest(file2, detailsForm) {
  fetchData(`./functions/${file2}`, detailsForm).then(res => res.text()).then(data => {
    if (data != 'Added') {
      errorMassege(data, 'red');
    } else {
      errorMassege('Added', 'green');
      location.reload();
    }
  })
}

