import{_ as i,b as n,a as r,j as d,A as o}from"./aos.fe03079a.js";window._=i;window.bootstrap=n;window.axios=r;window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";window.$=d;window.Aos=o;o.init({duration:1e3,once:!0,mirror:!0});document.addEventListener("livewire:load",function(){livewire.on("simpleToast",function(t,s,a){$("#liveToast").addClass(`toast text-bg-${t}`),$("#liveToast strong").html(s),$("#liveToast .toast-body").html(a);const e=$("#liveToast");new bootstrap.Toast(e).show()})});
