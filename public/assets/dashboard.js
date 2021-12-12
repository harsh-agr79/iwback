$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown({
        constrainWidth:false,
        coverTrigger:false, 
    });
    $('input#input_text, textarea#textarea2').characterCounter();
    $('.modal').modal();
    var today = new Date()
    var year = today.getFullYear()
    var month = today.getMonth() + 1
    var day = today.getDate()
    var hour = today.getHours()
    var minutes = today.getMinutes()
    var finalMonth = month + 3
    var finalYear = year
    
    if(finalMonth>12){
        finalMonth-=12
        finalYear = year + 1
    }
    if(day<10){
        day = '0'+day
    }
    if(month<10){
        month = '0'+month
    }
    if(finalMonth<10){
        finalMonth = '0'+finalMonth
    }
    if(hour<10){
        hour = '0'+hour
    }
    if(minutes<10){
        minutes = '0'+minutes
    }
    
    var dateFormat = `${year}-${month}-${day}`
    var maxDateFormat = `${finalYear}-${finalMonth}-${day}`
    let deadline = document.querySelector('#application-deadline')
    deadline.setAttribute('min', dateFormat)
    deadline.setAttribute('max', maxDateFormat)

    //chips
    $('.chips').chips();
    $('.chips-autocomplete').chips({
        autocompleteOptions: {
          data: {
            'Php': null,
            'HTML/HTML5': null,
            'Laravel': null,
            'React': null,
            'JavaScript': null,
            'Photoshop': null,
            'UI/UX': null,
            'Illustrator': null,
            'Word': null,
            'Excel': null,
            'MongoDB': null,
            'MySQL': null,
            'Node.js': null,
            'Express.js': null,
            'Next.js': null,
            'Git': null,
            'Npm': null,
            'After Effects': null,
            'CSS/CSS3': null
          },
          limit: Infinity,
          minLength: 1
        }
    });

    //salary post
    var salaryDiv = document.querySelector('#salary-div')

    $('#wbs').change(() => {
        if($('#salaryfld').attr('required')){
            $('#salaryfld').removeAttr('required')
            salaryDiv.classList.add('hide-block')
        }
        else{
            $('#salaryfld').attr('required','required')
            salaryDiv.classList.remove('hide-block')
        }
    })

    // const form = document.querySelector('.job-upload-form form')
    // const confirmationPage = document.querySelector('.confirmation-page')
    // form.addEventListener('submit',(e) => {
    //     e.preventDefault()
    //     form.classList.add('hide-block')
    //     confirmationPage.classList.add('show-page')
    // })

    //bottom navbar
    let bottomTab = document.querySelectorAll('.bottom-tab')
    for(let i=0; i<bottomTab.length; i++){
        bottomTab[i].onclick = function(){
            let j = 0
            while(j<bottomTab.length){
                bottomTab[j++].className = 'bottom-tab'
            }
            bottomTab[i].className = 'bottom-tab active'
        }
    }
});
