<div class="wrapper">
    <button class="button">Принять вызов</button>
</div>
<style>
	body {
		background-image: url("/pluton/images/duel-wallpers.jpg");
		background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
background-position:center;
	}

	.button {
    margin:auto;
  display:block;
  top: 50%;
  margin-top: 100px
}
.button {
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
.button span:after {
content: '\00bb';  /* CSS Entities. To use HTML Entities, use &#8594;*/
position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
.button:hover span {
  padding-right: 25px;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>