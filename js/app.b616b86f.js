(function(e){function t(t){for(var r,o,i=t[0],l=t[1],u=t[2],s=0,d=[];s<i.length;s++)o=i[s],Object.prototype.hasOwnProperty.call(a,o)&&a[o]&&d.push(a[o][0]),a[o]=0;for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(e[r]=l[r]);p&&p(t);while(d.length)d.shift()();return c.push.apply(c,u||[]),n()}function n(){for(var e,t=0;t<c.length;t++){for(var n=c[t],r=!0,o=1;o<n.length;o++){var i=n[o];0!==a[i]&&(r=!1)}r&&(c.splice(t--,1),e=l(l.s=n[0]))}return e}var r={},o={3:0},a={3:0},c=[];function i(e){return l.p+"js/"+({}[e]||e)+"."+{1:"e2ce49d5",2:"47d84d68",4:"cfb97d61",5:"7cb074f2",6:"511036c9",7:"2f989c34",8:"7b5e06c4",9:"a1617b15",10:"80d355c9",11:"ed44a7b6"}[e]+".js"}function l(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,l),n.l=!0,n.exports}l.e=function(e){var t=[],n={1:1,4:1,5:1,6:1,7:1,8:1,9:1,10:1};o[e]?t.push(o[e]):0!==o[e]&&n[e]&&t.push(o[e]=new Promise((function(t,n){for(var r="css/"+({}[e]||e)+"."+{1:"919627a4",2:"31d6cfe0",4:"f1e93b4e",5:"f82d10c3",6:"40814bfa",7:"cb37aa99",8:"9156335f",9:"828e7360",10:"30adac07",11:"31d6cfe0"}[e]+".css",a=l.p+r,c=document.getElementsByTagName("link"),i=0;i<c.length;i++){var u=c[i],s=u.getAttribute("data-href")||u.getAttribute("href");if("stylesheet"===u.rel&&(s===r||s===a))return t()}var d=document.getElementsByTagName("style");for(i=0;i<d.length;i++){u=d[i],s=u.getAttribute("data-href");if(s===r||s===a)return t()}var p=document.createElement("link");p.rel="stylesheet",p.type="text/css",p.onload=t,p.onerror=function(t){var r=t&&t.target&&t.target.src||a,c=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");c.code="CSS_CHUNK_LOAD_FAILED",c.request=r,delete o[e],p.parentNode.removeChild(p),n(c)},p.href=a;var f=document.getElementsByTagName("head")[0];f.appendChild(p)})).then((function(){o[e]=0})));var r=a[e];if(0!==r)if(r)t.push(r[2]);else{var c=new Promise((function(t,n){r=a[e]=[t,n]}));t.push(r[2]=c);var u,s=document.createElement("script");s.charset="utf-8",s.timeout=120,l.nc&&s.setAttribute("nonce",l.nc),s.src=i(e);var d=new Error;u=function(t){s.onerror=s.onload=null,clearTimeout(p);var n=a[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),o=t&&t.target&&t.target.src;d.message="Loading chunk "+e+" failed.\n("+r+": "+o+")",d.name="ChunkLoadError",d.type=r,d.request=o,n[1](d)}a[e]=void 0}};var p=setTimeout((function(){u({type:"timeout",target:s})}),12e4);s.onerror=s.onload=u,document.head.appendChild(s)}return Promise.all(t)},l.m=e,l.c=r,l.d=function(e,t,n){l.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},l.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,t){if(1&t&&(e=l(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(l.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)l.d(n,r,function(t){return e[t]}.bind(null,r));return n},l.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return l.d(t,"a",t),t},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.p="",l.oe=function(e){throw console.error(e),e};var u=window["webpackJsonp"]=window["webpackJsonp"]||[],s=u.push.bind(u);u.push=t,u=u.slice();for(var d=0;d<u.length;d++)t(u[d]);var p=s;c.push([0,0]),n()})({0:function(e,t,n){e.exports=n("2f39")},"0047":function(e,t,n){},"2f39":function(e,t,n){"use strict";n.r(t);n("e6cf"),n("5319"),n("7d6e"),n("e54f"),n("985d"),n("0047");var r=n("2b0e"),o=n("1f91"),a=n("42d2"),c=n("b05d"),i=n("18d6"),l=n("2a19");r["a"].use(c["a"],{config:{},lang:o["a"],iconSet:a["a"],plugins:{LocalStorage:i["a"],Notify:l["a"]}});var u=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"q-app"}},[n("router-view")],1)},s=[],d={name:"App"},p=d,f=n("2877"),h=Object(f["a"])(p,u,s,!1,null,null,null),b=h.exports,m=n("8c4f");const g=[{path:"/",component:()=>Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"4632")),children:[{path:"",component:()=>Promise.all([n.e(0),n.e(6)]).then(n.bind(null,"013f"))}]},{path:"/logout",component:()=>Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"4632")),children:[{path:"",component:()=>n.e(8).then(n.bind(null,"4ab3"))}]},{path:"/timeline",component:()=>Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"713b")),children:[{path:"",component:()=>Promise.all([n.e(0),n.e(5)]).then(n.bind(null,"8b24"))}]},{path:"/pet",component:()=>Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"713b")),children:[{path:"",component:()=>Promise.all([n.e(0),n.e(4)]).then(n.bind(null,"74ec"))}]},{path:"/user",component:()=>Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"713b")),children:[{path:"",component:()=>Promise.all([n.e(0),n.e(7)]).then(n.bind(null,"4336"))}]},{path:"/search",component:()=>Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"713b")),children:[{path:"",component:()=>Promise.all([n.e(0),n.e(9)]).then(n.bind(null,"e5b4"))}]},{path:"/my-pets",component:()=>Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"713b")),children:[{path:"",component:()=>Promise.all([n.e(0),n.e(11)]).then(n.bind(null,"ba5f"))}]},{path:"*",component:()=>Promise.all([n.e(0),n.e(10)]).then(n.bind(null,"e51e"))}];var y=g;r["a"].use(m["a"]);var v=function(){const e=new m["a"]({scrollBehavior:()=>({x:0,y:0}),routes:y,mode:"hash",base:""});return e},w=async function(){const e="function"===typeof v?await v({Vue:r["a"]}):v,t={router:e,render:e=>e(b),el:"#q-app"};return{app:t,router:e}},P=n("9483");Object(P["a"])("service-worker.js",{ready(){},registered(){},cached(){},updatefound(){},updated(){},offline(){},error(){}});var j=n("758b");/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream&&window.navigator.standalone&&n.e(0).then(n.t.bind(null,"a0db",7));const O="";async function S(){const{app:e,router:t}=await w();let n=!1;const o=e=>{n=!0;const r=Object(e)===e?t.resolve(e).route.fullPath:e;window.location.href=r},a=window.location.href.replace(window.location.origin,""),c=[j["b"]];for(let l=0;!1===n&&l<c.length;l++)if("function"===typeof c[l])try{await c[l]({app:e,router:t,Vue:r["a"],ssrContext:null,redirect:o,urlPath:a,publicPath:O})}catch(i){return i&&i.url?void(window.location.href=i.url):void console.error("[Quasar] boot error:",i)}!0!==n&&new r["a"](e)}S()},"758b":function(e,t,n){"use strict";n.d(t,"a",(function(){return c})),n.d(t,"c",(function(){return i}));n("e6cf");var r=n("bc3a"),o=n.n(r),a=n("d765");const c=o.a.create({baseURL:"https://sugarpuppy.azurewebsites.net/api",headers:{"Content-Type":"application/json","api-key":"c4e00bb8f7d21b50fc56a91d775f61d2"}});c.interceptors.response.use((e=>200!==e.data.status?Promise.reject(e.data):e.data.dados));const i=()=>{c.interceptors.request.use((e=>{const t=a["a"].get("login");return t&&(e.headers["access-key"]=t.access_key,e.headers["id-usuario"]=t.id_usuario,t.id_pet?e.headers["id-pet"]=t.id_pet:delete e.headers["id-pet"]),e}))},{CancelToken:l}=o.a,u=()=>l.source();t["b"]=async({Vue:e})=>{const t=a["a"].get("login");t&&i(),e.prototype.$axios=c,e.prototype.$updateAxiosHeaders=i,e.prototype.$getAxiosSource=u}},d765:function(e,t,n){"use strict";var r=n("18d6");const o="br.com.sugarpuppy_";t["a"]={set:(e,t)=>{try{const n=JSON.stringify(t);return r["a"].set(o+e,n),!0}catch(n){return console.log(n),!1}},get:e=>{try{const t=r["a"].getItem(o+e);return JSON.parse(t)}catch(t){return console.log(t),!1}},delete:e=>{try{return r["a"].remove(o+e),!0}catch(t){return console.log(t),!1}},clear:()=>{try{return r["a"].clear(),!0}catch(e){return console.log(e),!1}}}}});