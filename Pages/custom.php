<style>* {
  padding: 0;
  margin: 0;
  border-radius: 0;
  border: 0;
  box-shadow: none;
  outline: none;
  text-decoration: none;
  list-style: none;
  box-sizing: border-box;
}


#container {
  display: inline-block;
  
  width: 100%;
  height: 100%;
  
  padding: 2em;
  
  text-align: center;
}

a.button {
  display: inline-block;
  
  min-width: 5em;
  
  margin-right: 1ex;
  
  position: relative;
  top: calc(50% - 1em);
  
  text-align: center;
  font-size: 1.28em;
  
  background: rgba(0, 0, 0, 0.1);
  
  border: 2px solid white;
  
  transition: background 0.32s ease-in-out, box-shadow 0.32s ease-in-out;
}

a.button span {
  display: inline-block;
  
  width: 100%;
  height: 100%;
  
  padding: 1ex;
  
  color: white;
  
  transition: color 0.32s ease-in-out;
}
a.button:hover, a.button:focus, a.button.active {
  background: white;
  
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.48);
}
a.button:hover span, a.button:focus span, a.button.active span {
  color: #444;
}
</style>
<div id="container">
  <a href="#home" class="button1"><span>Home</span></a>
  <a href="#products" class="button1"><span>Products</span></a>
  <a href="#about" class="button1"><span>About</span></a>
  <a href="#contact" class="button1"><span>Contact</span></a>
</div>
<script>
  $(".button").click(function() {
    // Loại bỏ class 'active' từ tất cả các nút
    $(".button").removeClass("active");
    
    // Thêm class 'active' cho nút được nhấn
    $(this).addClass("active");
  });
</script>