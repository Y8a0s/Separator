import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;

import Select2 from 'select2';
Select2();

import Swal from 'sweetalert2';
window.Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    color: '#0d6efd',
    // background: 'whitesmoke',
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
  
// AOS 
import 'aos/dist/aos.css';
import Aos from 'aos';
window.Aos = Aos;
Aos.init({
    duration: 1000,
    once: true,
    mirror:true,
});

// bootstrap toast
document.addEventListener('livewire:load' , function(){
  livewire.on('simpleToast', function(color , title , message) {
    $('#liveToast').addClass(`toast text-bg-${color}`)
    $('#liveToast strong').html(title)
    $('#liveToast .toast-body').html(message)

    const livetoast = $('#liveToast')
    const toast = new bootstrap.Toast(livetoast)
    toast.show()
  });
});