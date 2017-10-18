<!DOCTYPE html>
<html>
    <head>
        <title><?= __('Error') ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <link href="<?= $view->url()->getStatic('system/theme:favicon.ico') ?>" rel="shortcut icon" type="image/x-icon">
        <link href="<?= $view->url()->getStatic('system/theme:apple_touch_icon.png') ?>" rel="apple-touch-icon-precomposed">
        <link href="<?= $view->url()->getStatic('system/theme:css/theme.css') ?>" rel="stylesheet">
        <script src="/app/assets/jquery/dist/jquery.min.js"></script>
    </head>
    <body>

        <div class="uk-height-viewport uk-flex uk-flex-center uk-flex-middle uk-text-center">
            <div class="tm-container">

                <img class="uk-margin-large-bottom" src="<?= $view->url()->getStatic('app/system/assets/images/sb_new_web-logo-large-black.svg') ?>" alt="SBWebApplication">

                <div class="uk-panel uk-panel-box">
                    <h1 class="uk-h2"><?= $title ?></h1>
                    <h2>Or maybe something goes wrong...just relax...and stop attacking the keyboard with your head!</h2>
                </div>

            </div>

        </div>
<div class='gamewrapper'>
  <div class='sky'>
    <div class='sun'></div>
    <div class='clouds'>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
      <div class='cloud'>
        <div class='big_bubble'></div>
        <div class='base'></div>
        <div class='small_bubble'></div>
      </div>
    </div>
    <div class='mountains'>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
      <div class='mountain'></div>
    </div>
    <div class='info'>
      <button class='js-play'>PLAY</button>
      <button class='js-instructions'>INSTRUCTIONS</button>
      <button class='js-tutorial'>TUTORIAL</button>
    </div>
  </div>
  <div class='land js-land'>
    <div class='game_info'>
      <span>Score:</span>
      <span class='score js-score'>0000</span>
      <span class='fraction'>
        <span class='right js-correct'>0</span>
        <span>/</span>
        <span class='total js-total'>0</span>
      </span>
    </div>
    <div class='trees'>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
      <div class='tree'>
        <div class='branch'></div>
        <div class='branch'></div>
        <div class='trunk'></div>
        <div class='shadow'></div>
      </div>
    </div>
  </div>
</div>
<style>
html, body {
  height: 100%;
  background:#EAE2D7;
}

body {
  position: relative;
  margin: 0;
}

select {
  border: none;
  outline: none;
}

button {
  outline: none;
  border: none;
  cursor: pointer;
}

body, button {
  font-family: 'Oswald', sans-serif;
  font-weight: 300;
}

/* LANDSCAPE */
.sky, .land {
  position: relative;
}

.sky {
  background-color: #D9F1FB;
  height: 14em;
}

.land {
  background-color: #EAE2D7;
  min-height: 30em;
}

.sun {
  position: relative;
  left: 24em;
  background: gold;
  height: 0;
  width: 0;
  padding: 2em;
  border-radius: 50%;
  border: .8em solid goldenrod;
}

/* CLOUDS */
.clouds .cloud {
  position: absolute;
}
.clouds .cloud .base {
  position: absolute;
  top: 2em;
  left: -1.5em;
  height: 1.6em;
  width: 8em;
  background-color: ghostwhite;
  border-radius: 1em;
  box-shadow: inset -2.2em 0 0 beige;
}
.clouds .cloud .big_bubble {
  border: 2.5em solid beige;
}
.clouds .cloud .small_bubble {
  position: absolute;
  top: 1em;
  left: -0.1em;
  border: 1.5em solid ghostwhite;
}
.clouds .cloud .small_bubble, .clouds .cloud .big_bubble {
  height: 0;
  width: 0;
  border-radius: 50%;
  transform: rotate(45deg);
  border-bottom-color: transparent;
  border-right-color: transparent;
}
.clouds .cloud:nth-child(1) {
  top: 1.5em;
  left: 13em;
  transform: scale(1.2);
}
.clouds .cloud:nth-child(2) {
  top: 1em;
  left: 33em;
  transform: scale(1.1, 0.9);
}
.clouds .cloud:nth-child(3) {
  top: .6em;
  left: 48em;
}
.clouds .cloud:nth-child(4) {
  top: 1em;
  left: 62em;
  transform: scale(1.1);
}
.clouds .cloud:nth-child(5) {
  top: 2em;
  left: 78em;
  transform: scale(1.1, 0.9);
}
.clouds .cloud:nth-child(6) {
  top: 1em;
  left: 88em;
  transform: scale(0.8);
}
.clouds .cloud:nth-child(7) {
  top: 1em;
  left: 1em;
  transform: scale(0.8);
}
.clouds .cloud:nth-child(9) {
  top: 1em;
  left: 1em;
  transform: scale(0.7);
}

/* MOUNTAINS */
.mountains {
  overflow: hidden;
  position: relative;
  height: 10em;
}
.mountains .mountain {
  position: absolute;
  bottom: -4em;
  height: 10em;
  width: 10em;
  transform: rotate(45deg);
  border-top-left-radius: 14%;
  border-top-right-radius: 80% 20%;
  border-bottom-left-radius: 20% 80%;
  background: linear-gradient(45deg, #737373 50%, transparent 50%) no-repeat, linear-gradient(-45deg, transparent 50%, #737373 50%) 0 90px no-repeat, linear-gradient(135deg, grey 57.5%, transparent 57.5%) no-repeat;
  background-size: 57.5%, 57.5%, 100%;
}
.mountains .mountain:nth-child(1), .mountains .mountain:nth-child(5), .mountains .mountain:nth-child(7), .mountains .mountain:nth-child(10), .mountains .mountain:nth-child(11) {
  transform: rotate(45deg) scale(1.2);
}
.mountains .mountain:nth-child(3), .mountains .mountain:nth-child(7), .mountains .mountain:nth-child(9) {
  background: linear-gradient(45deg, #8a8b18 50%, transparent 50%) no-repeat, linear-gradient(-45deg, transparent 50%, #8a8b18 50%) 0 90px no-repeat, linear-gradient(135deg, #a0a11c 57.5%, transparent 57.5%) no-repeat;
  background-size: 57.5%, 57.5%, 100%;
}
.mountains .mountain:nth-child(2) {
  left: 16em;
}
.mountains .mountain:nth-child(3) {
  left: 8em;
}
.mountains .mountain:nth-child(4) {
  left: 45em;
}
.mountains .mountain:nth-child(5) {
  left: 35em;
}
.mountains .mountain:nth-child(6) {
  left: 60em;
}
.mountains .mountain:nth-child(7) {
  left: 55em;
}
.mountains .mountain:nth-child(8) {
  left: 73em;
}
.mountains .mountain:nth-child(9) {
  left: 77em;
}
.mountains .mountain:nth-child(10) {
  left: 87em;
}
.mountains .mountain:nth-child(11) {
  left: 93em;
}

/* TREES */
.tree {
  background: #35740a;
  box-shadow: inset 1em 0 0 #408B0C;
  border-radius: 1em;
  height: 5em;
  width: 2em;
  transition: transform 1s;
}
.tree:nth-child(4n) {
  background: #da7b33;
  box-shadow: inset 1em 0 0 #de8949;
}
.tree .branch {
  border: .2em solid #563D3D;
  width: .8em;
  height: .8em;
  transform: rotate(45deg);
  border-top: 0;
  border-left: 0;
  position: relative;
}
.tree .branch:before, .tree .branch:after {
  content: '';
  height: 0.175em;
  width: 0.175em;
  background-color: #563D3D;
  border-radius: 50%;
  position: absolute;
}
.tree .branch:after {
  right: -0.178125em;
  top: -0.11875em;
}
.tree .branch:before {
  left: -0.11875em;
  bottom: -0.178125em;
}
.tree .branch:nth-child(1) {
  position: absolute;
  top: 35%;
  left: 25%;
}
.tree .branch:nth-child(2) {
  position: absolute;
  top: 60%;
  left: 25%;
}
.tree .shadow {
  height: .5em;
  width: 1.5em;
  background: rgba(198, 198, 198, 0.5);
  border-radius: 50%;
  position: absolute;
  bottom: -2.2em;
  left: 10%;
  z-index: -1;
  transition: width 1s;
}
.tree .shadow.blown {
  width: 2.5em;
}
.tree .trunk {
  background-color: #563D3D;
  height: 5.5em;
  width: .25em;
  border-radius: 0.5em;
  position: absolute;
  bottom: -2em;
  left: 42%;
}
.tree.blown {
  transition: transform 1s;
  transform: scale(0.7) skewX(-5deg) !important;
}
.tree.blown .shadow {
  width: 2.5em;
}

.trees {
  position: relative;
  z-index: 0;
}
.trees .tree {
  position: absolute;
  top: -3em;
  transform: scale(0.7);
}
.trees .tree:nth-child(1) {
  left: 18em;
  top: -3.2em;
}
.trees .tree:nth-child(2) {
  left: 33em;
  top: -3.5em;
}
.trees .tree:nth-child(3) {
  left: 24em;
}
.trees .tree:nth-child(4) {
  left: 45em;
}
.trees .tree:nth-child(5) {
  left: 35em;
}
.trees .tree:nth-child(6) {
  left: 66em;
}
.trees .tree:nth-child(7) {
  left: 55em;
  top: -3.6em;
}
.trees .tree:nth-child(8) {
  left: 73em;
}
.trees .tree:nth-child(9) {
  left: 75em;
  top: -3.1em;
}
.trees .tree:nth-child(10) {
  left: 83em;
  top: -2.8em;
}
.trees .tree:nth-child(11) {
  left: 89em;
}

/* INTERFACE */
button {
  background: yellow;
  font-size: 14px;
  border-radius: 1px;
  padding: 2px 8px 3px 8px;
}
button:active {
  background-color: yellowgreen;
}

.board .tree {
  position: absolute;
  transform: scale(0.7);
}

.blink {
  animation: blink 1s steps(2, start) infinite;
}

@keyframes blink {
  to {
    background-color: yellowgreen;
  }
}
.inkdot {
  animation-name: inkdot;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

@keyframes inkdot {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
.info {
  position: absolute;
  bottom: 0;
}

.start, .change_map, .difficulty {
  position: absolute;
  left: -4em;
  z-index: 10;
}

.start {
  top: 0;
}

.change_map {
  top: 2.2em;
}

.difficulty {
  top: 4.4em;
  font-size: 14px;
  background-color: silver;
}

.level {
  display: inline-block;
  padding: .125em;
}

.score {
  margin-right: .5em;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: black;
  opacity: .6;
  filter: alpha(opacity=60);
  z-index: 100;
}

.overlay-box {
  position: fixed;
  top: 10%;
  left: 50%;
  margin-left: -13em;
  z-index: 101;
}

.instructions-box {
  background: #c7baa8;
  border: 9px solid;
  width: 25em;
  height: 20em;
  border-radius: 1px;
  border-color: #f1c40f;
  border-bottom-color: #c29d0b;
  border-right-color: #dab10d;
  color: #66595c;
}

.js-close-overlay {
  cursor: pointer;
  position: absolute;
  left: 92%;
  top: 0%;
  color: #66595c;
}

.instructions {
  border: 1px solid #EAE2D7;
  padding: 1.8em 1em 1em 1em;
  height: 100%;
  box-sizing: border-box;
  font-family: sans-serif;
  line-height: 22px;
}
.instructions h2 {
  font-family: Oswald, sans-serif;
}

/* BOARD */
.board {
  display: inline-block;
  /* instead of overflow */
  padding: 3em 3em 1em 5em;
}
.board .cell {
  position: relative;
  float: left;
  /* for testing */
}

/* TREE / NODE */
.board .cell .node, .board .cell .non {
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 50%;
  z-index: 1;
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  cursor: pointer;
  font-size: 12px;
  height: 2.2em;
  width: 2.2em;
  line-height: 2.2em;
  text-align: center;
  background-color: skyblue;
}
.board .cell .node.extension, .board .cell .non.extension {
  background-color: palevioletred;
}
.board .cell .node.dead_end, .board .cell .non.dead_end {
  background-color: #424c56;
  display: none;
}
.board .cell .node.leaf, .board .cell .non.leaf {
  background-color: forestgreen;
  display: none;
}
.board .cell .node.root, .board .cell .non.root {
  background-color: yellowgreen;
}
.board .cell .node.blacknwhite, .board .cell .non.blacknwhite {
  background: #444;
  color: #f9f9f9;
}
.board .cell .edge {
  position: absolute;
  opacity: .4;
}
.board .cell .edge.selected {
  opacity: 1;
}
.board .cell.east .edge.east, .board .cell.east .edge.west, .board .cell.west .edge.east, .board .cell.west .edge.west {
  background: linear-gradient(0deg, transparent 22%, grey 22%, grey 33%, transparent 33%, transparent 67%, grey 67%, grey 78%, transparent 78%), repeating-linear-gradient(90deg, transparent, transparent 0.25em, #7B5026 0.25em, #7B5026 0.5em);
  top: .35em;
  right: 0;
  height: .9em;
  width: 5.6em;
}
.board .cell.east .edge.east.shorter, .board .cell.east .edge.west.shorter, .board .cell.west .edge.east.shorter, .board .cell.west .edge.west.shorter {
  right: 4.6em;
  width: 1em;
}
.board .cell.south .edge.south, .board .cell.south .edge.north, .board .cell.north .edge.south, .board .cell.north .edge.north {
  background: linear-gradient(90deg, transparent 22%, grey 22%, grey 33%, transparent 33%, transparent 67%, grey 67%, grey 78%, transparent 78%), repeating-linear-gradient(0deg, transparent, transparent 0.25em, #7B5026 0.25em, #7B5026 0.5em);
  left: .35em;
  bottom: 0;
  width: .9em;
  height: 5.6em;
}
.board .cell.joint .node {
  height: 1.5em;
  width: 1.5em;
  top: .7em;
  left: .7em;
  background: radial-gradient(rgba(0, 0, 0, 0) 33%, #808080 36%, #808080 39%, rgba(0, 0, 0, 0) 43%, rgba(0, 0, 0, 0) 57.5%, #808080 61.5%, #808080 63.5%, rgba(0, 0, 0, 0) 68%);
  background-size: 200% 200%;
  border-radius: 0;
  cursor: auto;
  display: block;
}
.board .cell.east_to_north .node, .board .cell.north_to_east .node {
  background-position: 0 100%;
  top: 0;
  left: .7em;
}
.board .cell.west_to_north .node, .board .cell.north_to_west .node {
  background-position: 100% 100%;
  top: 0;
  left: 0;
}
.board .cell.west_to_south .node, .board .cell.south_to_west .node {
  background-position: 100% 0;
  top: .7em;
  left: 0;
}
.board .cell.south_to_north .node, .board .cell.north_to_south .node {
  display: none;
}
.board .cell.south_to_north .south.edge, .board .cell.north_to_south .south.edge {
  height: 100%;
}
.board .cell.east_to_west .node, .board .cell.west_to_east .node {
  display: none;
}
.board .cell.east_to_west .east.edge, .board .cell.west_to_east .east.edge {
  width: 100%;
}

/* PLANKS */
.plank {
  height: 0.25em;
  width: .875em;
  background-color: #7B5026;
  position: absolute;
}
.plank:nth-child(1) {
  transform: rotate(45deg);
  left: 0.6875em;
  top: 0.9375em;
}
.plank:nth-child(2) {
  transform: rotate(22.5deg);
  left: 0.4375em;
  top: 1.3125em;
}
.plank:nth-child(3) {
  transform: rotate(67.5deg);
  left: 1.0625em;
  top: 0.6875em;
}

.west_to_south .plank:nth-child(1), .south_to_west .plank:nth-child(1) {
  top: 1em;
  left: 0.0625em;
  transform: rotate(-45deg);
}
.west_to_south .plank:nth-child(2), .south_to_west .plank:nth-child(2) {
  top: 1.3125em;
  left: 0.3125em;
  transform: rotate(-22.5deg);
}
.west_to_south .plank:nth-child(3), .south_to_west .plank:nth-child(3) {
  top: 0.75em;
  left: -0.25em;
  transform: rotate(-67.5deg);
}

.west_to_north .plank:nth-child(1), .north_to_west .plank:nth-child(1) {
  transform: rotate(45deg);
  top: 0.375em;
  left: 0.1875em;
}
.west_to_north .plank:nth-child(2), .north_to_west .plank:nth-child(2) {
  transform: rotate(22.5deg);
  top: -0.0625em;
  left: 0.375em;
}
.west_to_north .plank:nth-child(3), .north_to_west .plank:nth-child(3) {
  transform: rotate(67.5deg);
  top: 0.625em;
  left: -0.1875em;
}

.east_to_north .plank:nth-child(1), .north_to_east .plank:nth-child(1) {
  transform: rotate(-45deg);
  left: 0.625em;
  top: 0.4375em;
}
.east_to_north .plank:nth-child(2), .north_to_east .plank:nth-child(2) {
  transform: rotate(-22.5deg);
  left: 0.4375em;
  top: 0;
}
.east_to_north .plank:nth-child(3), .north_to_east .plank:nth-child(3) {
  transform: rotate(-67.5deg);
  left: 1.0625em;
  top: 0.6875em;
}

/* HOUSE */
.house.white .roof {
  background: #f9a745;
}
.house.white .side {
  background: #d28a48;
}
.house.white .front {
  background: #f7f3dd;
}
.house.white .front:before {
  border-bottom: 1.625em solid #f7f3dd;
}

.house.red .roof {
  background: #aba195;
}
.house.red .side {
  background: #b3322a;
}
.house.red .front {
  background: #d45149;
}
.house.red .front:before {
  border-bottom: 1.625em solid #d45149;
}

.house {
  position: relative;
  width: 4.8em;
}
.house .front {
  width: 2.25em;
  height: 2.25em;
  background-color: #ddaf3e;
  position: relative;
  float: left;
}
.house .front:before {
  content: '';
  position: absolute;
  height: 0;
  width: 0;
  top: -2.75em;
  border: 1.125em solid transparent;
  border-bottom: 1.625em solid #ddaf3e;
}
.house .side {
  height: 2.25em;
  width: 2.5em;
  background-color: #99751b;
  float: left;
  padding: 0.625em;
  box-sizing: border-box;
  text-align: center;
  color: antiquewhite;
  text-shadow: 0 0 whitesmoke;
  line-height: 1.125em;
}
.house .roof {
  height: 1.625em;
  width: 2.5em;
  transform: skewX(35deg);
  background-color: #bc8f21;
  position: absolute;
  top: -1.625em;
  right: 0.625em;
}
.house .tunnel {
  height: 1.375em;
  width: 1.5em;
  background-color: #2e2e2e;
  position: absolute;
  left: 0.375em;
  bottom: 0;
}
.house .tunnel:before {
  content: '';
  position: absolute;
  top: -0.6875em;
  left: 0;
  width: 0;
  height: 0;
  transform: rotate(45deg);
  border: 0.75em solid transparent;
  border-top-color: #2e2e2e;
  border-left-color: #2e2e2e;
  border-radius: 50%;
}
.house.west {
  top: -1em;
  left: -0.125em;
  transform: scaleX(-1);
}
.house.west .side {
  transform: scaleX(-1);
}
.house.east {
  top: -1em;
}
.house.north {
  top: -0.625em;
  left: -0.375em;
}
.house.south {
  left: 2.25em;
  top: -1em;
}

/* DEATH */
.death *, .death :after, .death :before {
  box-sizing: border-box;
}
.death .pull-left {
  float: left;
}
.death .pull-right {
  float: right;
}
.death .clearfix:after, .death .clearfix:before {
  content: '';
  display: table;
}
.death .clearfix:after {
  clear: both;
  display: block;
}

.death .head .skull:before,
.death .head .skull:after,
.death .eyes .eye:before,
.death .body:before,
.death .body:after,
.death .legs:before {
  content: '';
  position: absolute;
}

.death {
  width: 30px;
  height: 44px;
  position: absolute;
  top: -1em;
  left: -0.5em;
  animation: move 5s infinite;
}

.west .death {
  top: -1em;
  left: 0em;
}

.north .death {
  top: -1em;
  left: -0.5em;
}

.death .head {
  z-index: 1;
  width: 25px;
  height: 25px;
  background: #444;
  border-radius: 50%;
  position: relative;
}

.death .head .skull {
  left: 2px;
  bottom: 2px;
  width: 16px;
  height: 16px;
  color: #f9f9f9;
  border-radius: 50%;
  background: #f9f9f9;
  position: absolute;
  animation: skull 5s infinite;
}

.death .head .skull:before {
  top: 9px;
  width: 0;
  left: 50%;
  height: 0;
  z-index: 1;
  margin-left: -2px;
  border: 2px solid transparent;
  border-bottom: 2px solid #444;
}

.death .head .skull:after {
  top: 14px;
  left: 50%;
  width: 1px;
  height: 4px;
  margin-left: -1px;
  background: #f9f9f9;
  box-shadow: 2px 0, -2px 0, 4px 0, -4px 0, -3px -2px, -1px -2px, 1px -2px, 3px -2px;
}

.death .eyes {
  width: inherit;
  height: inherit;
  overflow: hidden;
  border-radius: 50%;
  position: relative;
}

.death .eyes .eye {
  top: 5px;
  width: 5px;
  height: 5px;
  position: absolute;
  border-radius: 50%;
  background: #f8cd22;
  border: 1px solid #444;
  border-right: 2px solid #444;
}

.death .eyes .eye:before {
  top: -1px;
  left: -1px;
  width: 5px;
  height: 3px;
  background: #f9f9f9;
  border-radius: 5px 5px 0 0;
  animation: eyes 5s infinite;
}

.death .eyes .eye.eye-left {
  left: 1px;
}

.death .eyes .eye.eye-right {
  right: 1px;
}

.death .body {
  top: -3px;
  width: 24px;
  height: 17px;
  background: #444;
  position: relative;
  border-radius: 10px 10px 2px 2px;
}

.death .body:before,
.death .body:after {
  top: 3px;
  width: 4px;
  height: 12px;
  background: #444;
}

.death .body:before {
  left: -1px;
  border-radius: 100% 0 0 2px;
  transform: rotate(10deg);
  animation: hand-left 5s infinite;
}

.death .body:after {
  right: -1px;
  border-radius: 0 100% 2px 0;
  transform: rotate(-10deg);
  animation: hand-right 5s infinite;
}

.death .legs {
  top: -3px;
  left: 50%;
  width: 21px;
  height: 10px;
  overflow: hidden;
  margin-left: -13px;
  position: relative;
  border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}

.death .legs:before {
  top: 0;
  left: -7px;
  width: 60px;
  height: 10px;
  background-image: linear-gradient(-495deg, #444 4px, transparent 0), linear-gradient(-45deg, transparent 4px, #444 0);
  background-size: 4px 8px;
  background-repeat: repeat-x;
  animation: legs 5s infinite;
}

@keyframes move {
  0% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(15px);
  }
  100% {
    transform: translateX(0);
  }
}
@keyframes skull {
  0% {
    transform: translate(0, 0);
  }
  25% {
    transform: translate(2px, 1px);
  }
  75% {
    transform: translate(3px, -1px);
  }
  100% {
    transform: translate(0, 0);
  }
}
@keyframes eyes {
  0% {
    top: -5px;
    border-radius: 50%;
  }
  50% {
    top: -1px;
    border-radius: 5px 5px 0 0;
  }
  100% {
    top: -5px;
    border-radius: 50%;
  }
}
@keyframes legs {
  0% {
    left: -7px;
  }
  50% {
    left: -25px;
  }
  100% {
    left: -7px;
  }
}
@keyframes hand-left {
  0% {
    left: 1px;
  }
  50% {
    left: -2px;
  }
  100% {
    left: 1px;
  }
}
@keyframes hand-right {
  0% {
    right: 1px;
  }
  50% {
    right: -2px;
  }
  100% {
    right: 1px;
  }
}
/* CLOUD ANIMATIONS */
.sky .clouds .cloud {
  animation-name: drift;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}
.sky .clouds .cloud:nth-child(1) {
  animation-duration: 90s;
  animation-delay: -8s;
  z-index: 1;
}
.sky .clouds .cloud:nth-child(2) {
  animation-duration: 94s;
  animation-delay: -45s;
  z-index: 1;
}
.sky .clouds .cloud:nth-child(3) {
  animation-duration: 90s;
  animation-delay: -80s;
}
.sky .clouds .cloud:nth-child(4) {
  animation-duration: 92s;
  animation-delay: -21s;
  z-index: 1;
}
.sky .clouds .cloud:nth-child(5) {
  animation-duration: 95s;
  animation-delay: -30s;
}
.sky .clouds .cloud:nth-child(6) {
  animation-duration: 90s;
  animation-delay: -65s;
}
.sky .clouds .cloud:nth-child(7) {
  animation-duration: 98s;
  animation-delay: -4s;
}
.sky .clouds .cloud:nth-child(8) {
  animation-duration: 95s;
  animation-delay: -78s;
  z-index: 1;
}
.sky .clouds .cloud:nth-child(9) {
  animation-duration: 95s;
  animation-delay: -60s;
}

@keyframes drift {
  0% {
    left: -8em;
  }
  100% {
    left: 103em;
  }
}
/* TRAIN */
.train, .pilot, .stack, .engine, .wheels {
  box-sizing: border-box;
}

.train {
  z-index: 2;
  width: 2.5em;
  height: 2.5em;
  margin-top: .125em;
}
.train .destination {
  font-size: .75em;
  text-align: center;
  font-weight: 400;
  line-height: 1.2em;
}
.train .pilot {
  width: 60%;
  height: 60%;
  float: left;
  background: linear-gradient(45deg, #e3f3ff, #bddcee) 0 0.3em;
  border: 0.1875em solid darkseagreen;
  border-bottom-width: .5em;
  border-right-width: .4em;
  position: relative;
}
.train .pilot:before {
  content: '';
  position: absolute;
  height: .125em;
  width: 1.75em;
  background: #f3cb00;
  top: -0.3125em;
  left: -0.3125em;
}
.train .stack, .train .engine {
  height: 30%;
  width: 40%;
  float: right;
}
.train .stack {
  position: relative;
}
.train .stack:before {
  content: '';
  position: absolute;
  height: .625em;
  width: .625em;
  top: 0.1875em;
  left: 0.1875em;
  border: .125em solid transparent;
  border-top-color: darkgrey;
  border-top-width: 0.1875em;
  border-left-width: 0.1875em;
  border-right-width: 0.1875em;
  border-bottom-width: 0;
  box-sizing: border-box;
  background: linear-gradient(to right, darkseagreen 50%, transparent 50%);
  background-size: 200%;
}
.train .engine {
  background: darkseagreen;
  border-top-right-radius: 70% 50%;
  border-bottom-right-radius: 10%;
}
.train .wheels {
  position: relative;
  /* this looks weird as em */
  top: -4px;
  left: 1px;
  height: 40%;
}
.train .wheels .wheel {
  position: relative;
  border: .125em solid slategrey;
  height: 0.5625em;
  width: 0.5625em;
  border-radius: 50%;
  float: left;
}
.train .wheels .wheel .spoke {
  background-color: rgba(95, 70, 34, 0.49);
  position: absolute;
  top: 0;
  left: 4px;
  width: 1px;
  height: 100%;
}
.train .wheels .wheel .spoke:nth-child(1) {
  transform: rotate(0deg);
}
.train .wheels .wheel .spoke:nth-child(2) {
  transform: rotate(45deg);
}
.train .wheels .wheel .spoke:nth-child(3) {
  transform: rotate(90deg);
}
.train .wheels .wheel .spoke:nth-child(4) {
  transform: rotate(-45deg);
}

/* TRAINS ANIMATIONS */
.train {
  position: absolute;
  animation-timing-function: linear;
  animation-fill-mode: forwards;
  animation-duration: 4s;
  transform-origin: 10px 30px;
}
.train.to_east {
  top: -16px;
  left: 6px;
}
.train.to_south {
  top: -16px;
  left: 0px;
  transform: rotate(90deg);
}
.train.to_south .destination {
  transform: rotate(270deg);
}
.train.to_west {
  top: -22px;
  left: 0px;
  left: 116px;
  transform: rotate(180deg);
}
.train.to_west .destination {
  transform: rotate(180deg);
}
.train.to_north {
  left: 6px;
  top: -22px;
  top: 94px;
  transform: rotate(270deg);
}
.train.to_north .destination {
  transform: rotate(90deg);
}

@keyframes to_east {
  100% {
    left: 99px;
  }
}
@keyframes to_south {
  100% {
    top: 77px;
  }
}
@keyframes to_west {
  100% {
    left: 23px;
  }
}
@keyframes to_north {
  100% {
    top: 1px;
  }
}
@keyframes east_to_south {
  0% {
    left: 99px;
    transform: rotate(0deg);
  }
  100% {
    left: 116px;
    transform: rotate(90deg);
  }
}
@keyframes south_to_west {
  0% {
    top: 77px;
    transform: rotate(90deg);
  }
  100% {
    top: 94px;
    transform: rotate(180deg);
  }
}
@keyframes west_to_north {
  0% {
    left: 23px;
    transform: rotate(180deg);
  }
  100% {
    left: 6px;
    transform: rotate(270deg);
  }
}
@keyframes north_to_east {
  0% {
    top: 1px;
    transform: rotate(270deg);
  }
  100% {
    top: -16px;
    transform: rotate(360deg);
  }
}
@keyframes east_to_east {
  0% {
    left: 99px;
  }
  100% {
    left: 122px;
  }
}
@keyframes south_to_south {
  0% {
    top: 77px;
  }
  100% {
    top: 100px;
  }
}
@keyframes west_to_west {
  0% {
    left: 23px;
  }
  100% {
    left: 0px;
  }
}
@keyframes north_to_north {
  0% {
    top: 1px;
  }
  100% {
    top: -22px;
  }
}
@keyframes east_to_north {
  0% {
    top: -16px;
    left: 99px;
    transform: rotate(0deg);
  }
  100% {
    top: -22px;
    left: 122px;
    transform: rotate(-90deg);
  }
}
@keyframes south_to_east {
  0% {
    left: 0px;
    top: 77px;
    transform: rotate(90deg);
  }
  100% {
    left: 6px;
    top: 100px;
    transform: rotate(0deg);
  }
}
@keyframes west_to_south {
  0% {
    top: -22px;
    left: 23px;
    transform: rotate(180deg);
  }
  100% {
    top: -16px;
    left: 0px;
    transform: rotate(90deg);
  }
}
@keyframes north_to_west {
  0% {
    left: 6px;
    top: 1px;
    transform: rotate(270deg);
  }
  100% {
    left: 0px;
    top: -22px;
    transform: rotate(180deg);
  }
}
.wheel {
  animation: spin_wheels .3s linear infinite;
}

@keyframes spin_wheels {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-45deg);
  }
}
/* TUTORIAL */
.pulse {
  animation: pulse 1.5s alternate ease-in infinite;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.5);
  }
}
@keyframes flash {
  0% {
    opacity: 1;
  }
  100% {
    opacity: .5;
  }
}
.radiate {
  animation: flash 1s alternate infinite, pulse 2s alternate infinite;
}

.faded {
  opacity: .3 !important;
}

.tutorial_message {
  width: 8em;
  padding: 1em;
  position: absolute;
  top: -6.25em;
  left: -0.5em;
  background: #EAE2D7;
  text-shadow: 1px 1px #d7d7de;
  border-radius: .25em;
}

/* SCORE */
.chewy {
  font-family: 'Chewy', cursive;
  position: absolute;
  left: 2em;
  z-index: 4;
  color: #f3cd33;
}
.chewy.red {
  color: #bf4233;
}

.puff_1 {
  animation: puff_1 6s forwards;
}

.puff_2 {
  animation: puff_2 6s forwards;
}

.puff_3 {
  animation: puff_3 6s forwards;
}

@keyframes puff_1 {
  0% {
    transform: translate(0, 0) scale(0);
    opacity: 0;
  }
  30% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: translate(-20px, -80px) scale(2.35);
  }
}
@keyframes puff_2 {
  0% {
    transform: translate(0, 0) scale(0);
    opacity: 0;
  }
  30% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: translate(-60px, -60px) scale(2.35);
  }
}
@keyframes puff_3 {
  0% {
    transform: translate(0, 0) scale(0);
    opacity: 0;
  }
  30% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: translate(40px, -80px) scale(2.35);
  }
}
.ending-overlay {
  margin-left: -10.875em;
  top: 40%;
  padding: 4em;
  padding-top: 0em;
}
.ending-overlay .headline {
  text-shadow: 2px 2px #7b8188;
  font-size: 2em;
  text-align: center;
}
.ending-overlay .headline span {
  padding: 0.1em;
}
.ending-overlay .message {
  color: #F5F7FA;
  margin-top: 0;
  min-width: 13.75em;
  text-align: center;
}
.ending-overlay .accuracy {
  color: #48CFAD;
  font-size: 0.8em;
  text-align: right;
}
.ending-overlay .close {
  color: #F5F7FA;
}
.ending-overlay .js-close-overlay {
  top: -12%;
  left: 78%;
}

.centered {
  margin: auto;
  display: block;
}

.gamewrapper {
  overflow: hidden;
}

</style>
<script>
const EAST = 'east';
const SOUTH = 'south';
const NORTH = 'north';
const WEST = 'west';

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function validDirection(direction) {
    return [EAST, WEST, SOUTH, NORTH].includes(direction);
}

function flipDirection(direction) {
    switch (direction) {
        case NORTH:
            return SOUTH;
            break;
        case SOUTH:
            return NORTH;
            break;
        case EAST:
            return WEST;
            break;
        case WEST:
            return EAST;
            break;
        default:
            return null;
    }
}

// cell is a gamewrapper for a jquery element, I want to add functionality to certain elements
// the only function that matters in this class is around, it is a modified prev/next
// all other functions build off around or are delegated to board
// the board class is the only class that creates new cells
// element - a jquery element
// board - what board does this cell belong to?
function Cell(element, board) {

    if(!element || !board) {
        return null;
    }

  this.element = function() {
    return element;
  };

    this.board = function() {
        return board;
    };

    this.isTaken = function() {
        return this.hasClass('js-taken');
    };

    this.markTaken = function() {
        this.addClass('js-taken');
        return this;
    };

    this.around = function (direction) {
        var width = board.width();
        var index = element.index() + 1; // remember index is dynamic

        switch (direction) {
            case NORTH:                
                return board.cell(index-width);
                break;
            case SOUTH:                                
                return board.cell(index+width);
                break;
            case EAST:
                return index % width == 0 ? null : board.cell(index+1);
                break;
            case WEST:
                return (index % width == 1) || (width == 1) ? null : board.cell(index-1);
                break;
            case undefined:
              return [this.around(NORTH), this.around(EAST), this.around(SOUTH), this.around(WEST)];
              break;
            default:                
                return null;                
        }
    };

    this.open = function (direction) {
        switch (direction) {
            case NORTH:
            case SOUTH:
            case EAST:
            case WEST:
                var cell = this.around(direction);
                break;
            default:
                return [].concat(this.open(NORTH), this.open(EAST), this.open(SOUTH), this.open(WEST));
        }
        
        return (cell == null) || !cell.isTaken() ? direction : [];
    };

    this.random_directions = function (num) {
        var open = this.open();

        // default
        if (num == null) {
            num = 1;
        }

        if ((num > 4) || (num > open.length) || (num <= 0)) {
            return []; // fail case
        } else if (num == open.length) {
            return open; // array
        } else if (num == 1) {
            return [open[Math.floor(Math.random() * open.length)]]
        } else {
            while (open.length != num) {
                var i = Math.floor(Math.random() * open.length);
                open.splice(i, 1);
            }
            return open;
        }
    };

    this.dead_end = function () {
        return this.open().length == 0;
    };

  return $.extend(this, element);
}

// board is a container class for an array of jquery elements, it is also a jquery element
// selector - a javascript class for the board
// where - where do you want it?
function Board(selector, where) {
    const em = 7.25;
    var width = height = 1;
    var colorful = false;
    var cell = '<div class="cell" style="width: '+em+'em; height: '+em+'em;"></div>';
    
    if(!selector) {
        selector = '.js-board';
    }

    if(!where) {
        where = '.js-land';
    }
    
    $(selector).remove();    
    $(where).append('<div class="'+selector.slice(1)+' board" style="width:'+em+'em;">'+cell+'</div>');
    var board = $(selector);

    this.height = function () {   
      return height;        
    };

    this.width = function () { 
      return width;    
    };

    // visual, the css width
    this.setWidth = function (value) {
        board.css('width', (value  * em) + 'em');
    };

    this.colorful = function(value) {
      if(value == undefined) {
        return colorful;        
      } else {
        colorful = value;
      }     
    };

    this.remove = function () { 
        board.remove();   
    };
    
    this.addTree = function (index, x, y, z) {
        var tree = '<div class="tree"><div class="branch"></div><div class="branch"></div><div class="trunk"></div><div class="shadow"></div></div>';
        tree = $(tree).css('left', x).css('top', y).css('z-index', z);            
        tree = this.cell(index).append(tree);        
    };

    this.cell = function(index) {        
        if((index > (height * width)) || (index <= 0)) {
            return null;
        } else {
            return new Cell($('.cell', board).eq(index - 1), this);    
        }   
    };

    this.expand = function(direction) {
        if(colorful) {
            cell = "<div class='cell' style='width: "+em+"em; height: "+em+"em; background:"+getRandomColor()+"'></div>";
        }
        
        switch (direction) {
            case NORTH:
            case SOUTH:
                var row = cell.repeat(width);                 
                height++;
                break;
            case WEST:
                $('.cell:nth-child(' + width + 'n+1)').before(cell);
                break;            
            case EAST:
                $('.cell:nth-child(' + width + 'n)').after(cell);                
                break;
        }

        switch (direction) {
            case NORTH:
                board.prepend(row);
                break;
            case SOUTH:
                board.append(row);
                break;
            case WEST:
            case EAST:   
              width++;
                this.setWidth(width);                
                break;
        }
    };    
}
;
// cell - what cell does the node belong to?
function Node(cell) {

  this.cell = function() {  
    return cell;      
  };

    this.tree = function() {    
        return tree;            
    };

    this.id = function(value) {
        // can be removed if new Node is pinned down
        // otherwise there is no way to preserve the value of id
        if(value == undefined) {
            return $(this).attr('data-node-id') || '';
        } else {
            $(this).attr('data-node-id', value);
        }   
    };

    this.render = function() {
        // prevent reinitialization, maybe there should be static methods
        if(!cell.isTaken()) {    
            cell.markTaken().append("<div class='node'></div><div class='east edge'></div><div class='south edge'></div>");
        }

        return $.extend(this, cell.element().find('.node'));
    };

    /*** the following methods deal with branching ***/

    // take_one: deals with details of 'branching', expands board if necessary, checks if node is available, sets node ID, and draws edges
    // direction - the direction to branch towards
    // returns - the taken node, null if it couldn't be done
    this.take_one = function (direction) {
        var node = null;
        var look = cell.around(direction);

        // cell is null, so that part of the board doesn't exist yet
        if (look == null) {
            cell.board().expand(direction);
            look = cell.around(direction);
        }

        if (look.isTaken()) {
            return null;
        } else {                    
            node = new Node(look).render();
        }

        // draw the edge between the calling node and the just taken node
        // these cell level cardinal classes are for the edges, and so you can determine parent/child relationships
        // remember south and east edges are in the calling node, north and west edges are in the adjacent nodes
        if ([SOUTH, EAST].indexOf(direction) > -1) {
            cell.addClass(direction);            
        } else {
            look.addClass(direction);            
        }
              
        return node;
    };

    // take: calls take_one for each direction given, defaults to ONE random direction if none given
    // directions - a list of directions to take
    // returns - the list of taken nodes, empty array if it couldn't be done
    this.take = function (directions) {
        var taken = [];
        var node = null;

        if (directions == null) {
            directions = cell.random_directions();
        } else if (directions.constructor.name == 'String') {
            // casting to array
            directions = directions.split();
        }

        for (var i = 0; i < directions.length; i++) {
            node = this.take_one(directions[i]);

            // don't return nulls
            if (node != null) {
                taken.push(node);
            }
        }

        return taken;
    };

    // branch: branches a node into given directions, unlike take or take_one, this function attempts to fix issues and
    // deals with the relationship between nodes
    // directions - number of directions to branch or an array of directions
    // probablity - the probability of extending before branching
    this.branch = function (directions, probability) {

        if (cell.dead_end()) {
            new Death(this);
            return [];
        }

        var num = 0;

        if (directions.constructor.name == 'Array') {
            num = directions.length;
        }
        else if (directions.constructor.name == 'Number') {
            num = directions;
        }

        // obviously impossible
        if ((num > 4) || (num <= 0)) {
            return [];
        }

        // if we made it this far into the function, we know num is valid and we are not at a dead end
        // so there must be at least 1 open

        // a random number between 1 and 100, determines whether or not this branch will extend
        var rand_num = Math.floor((Math.random() * 100) + 1);

        var curr_node = this;
        var curr_cell = cell;

        // while this current node cannot support <num> children and is not at a dead end, then extend
        // or
        // while there is a probability of extending, then extend
        while (curr_cell.open().length < num && !curr_cell.dead_end() || (rand_num <= probability && !curr_cell.dead_end())) {       
            curr_node = curr_node.extend2(); 
            curr_cell = curr_node.cell();                     
            probability = 0;
        }

        // after the while loop we should have a node with enough open or we are at a dead end
        var nodes = [];

        // we extended into a dead end :(
        if (curr_cell.dead_end()) {            
            new Death(curr_node);
        }
        else {

            // we'll return the children below
            if (directions.constructor.name == 'Array') {
                nodes = curr_node.take(directions);
            }
            else if (directions.constructor.name == 'Number') {
                for (var i = 0; i < directions; i++) {
                    nodes = nodes.concat(curr_node.take());
                }
            }

            // highlight a random edge
            curr_node.switchTracks();
        }

        return nodes;
    };

    this.extend2 = function(direction) {        
        if (!direction) {
            // get a random direction, if none given
            direction = this.cell().random_directions()[0];
        }

        // take it, hightlight the edge        
        var ext_node = this.take(direction)[0];
        this.highlight(direction);

        // find the direction of parent 
        var parent = this.parentDirection();

        // only root has null parent, so if not root
        if(parent != null) {
            this.toJoint(parent, direction);                  
        }
        
        return ext_node;
    };

    /*** the folloing methods do node operations ***/

    // switchTracks - highlights and sets arrow for node in a different direction
    this.switchTracks = function () {
        var current = this.selected();
        var kids = this.kids();
        var next = kids[0];

        if (kids.length == 1) {
            return;
        }

        if (current) {        
            var next = $(kids).not([current])[0];
        }

        // turn off the current
        this.highlight(current);

        // turn on the next
        this.highlight(next);
        this.setArrow(next);

      
        if (this.attr('data-avoid')) {
            // then this node has a timeout request
            this.switchBack(next);
        }
    };

    this.switchBack = function (next) {
        var avoid = this.attr('data-avoid');
        var timeout = this.attr('data-timeout');

        if(next == avoid) {
            // then there is no need to set the trap
            // mark complete, remove the inkdot timer
            this.addClass('blacknwhite').siblings('.js-inkdot').remove();
            this.attr('data-timeout', null);
            // unset the trap
            clearTimeout(timeout);
        } else if (next != avoid) {
            // then the trap needs to be set
            this.removeClass('blacknwhite');
            var time_limit = game.deathTimer();

            // add the timer
            this.after('<div class="js-inkdot inkdot non blacknwhite" style="animation-duration: '+time_limit+'s;">↻</div>');

            if(!timeout) {
                var self = this;
                timeout = setTimeout(function(){ self.switchTracks() }, time_limit * 1000);                
                this.attr('data-timeout', timeout);        
            }             
        }
    };

    // highlight: highlights an edge, will toggle highlight
    // direcion - the direction to (un)highlight
    this.highlight = function (direction) {
            
        // south and east is just south and east
        var op_cell = cell;
        
        switch (direction) {
            case NORTH:
            case WEST:
                op_cell = cell.around(direction);
                if(op_cell) {
                    direction = (direction == NORTH ? SOUTH : EAST);
                } else {
                    return;
                }
                break;
        }

        $('.edge.' + direction, op_cell).toggleClass('selected'); 
    };

    // setArrow: sets the arrow in the node
    // direction - the direcion of the arrow
    this.setArrow = function (direction) {
        var arrow = '';
        switch (direction) {
            case SOUTH:
                arrow = '&darr;';
                break;
            case EAST:
                arrow = '&rarr;';
                break;
            case NORTH:
                arrow = '&uarr;';
                break;
            case WEST:
                arrow = '&larr;';
                break;
            default:                   
        }

        this.html(arrow);
    };

    /*** the following methods are reflective ***/

    this.parentDirection = function () {
        if (cell.hasClass(WEST)) {
            return EAST;
        }

        if (cell.hasClass(NORTH)) {
            return SOUTH;
        }

        var n = cell.around(NORTH);
        if (n && n.hasClass(SOUTH) && !new Node(n).isLeaf()) {
            return NORTH;
        }

        var w = cell.around(WEST);
        if (w && w.hasClass(EAST) && !new Node(w).isLeaf()) {
            return WEST;
        }

        return null;
    };

    this.parentNode = function () {        
        var node = this;
        var direction = "";

        while(!node.isParent()) {
            direction = node.parentDirection();
            node = node.around(direction);
        }

        // ok this shouldn't be here
        direction = flipDirection(direction);
        node.attr('data-avoid', direction);

        return node;
    };

    this.around = function(direction) {
        var op_cell = cell.around(direction);
        return new Node(op_cell);
    }

    this.isParent = function() {        
        return !(this.hasClass('extension') || this.isDeadEnd());
    }

    this.kids = function () {
        var kids = [];

        // just for performance, this function will work without this check
        if (this.hasClass('leaf')) {
            return [];
        }

        var c = cell.around(NORTH);
        if (c && c.hasClass(NORTH)) {
            kids.push(NORTH);
        }

        c = cell.around(WEST);
        if (c && c.hasClass(WEST)) {
            kids.push(WEST);
        }

        if (cell.hasClass(EAST)) {
            kids.push(EAST);
        }

        if (cell.hasClass(SOUTH)) {
            kids.push(SOUTH);
        }

        return kids;
    };

    // selected: finds a node's selected edge
    // direction - the edge direction to see if selected, null checks all
    // returns - returns the direction selected
    this.selected = function (direction) {

        if (direction == null) {
            return (this.selected(NORTH) || this.selected(SOUTH) || this.selected(EAST) || this.selected(WEST));
        } 

        // a node can only select its kids, this is important
        if (this.kids().indexOf(direction) < 0) {            
            return null;
        }

        var op_cell = cell;
        var op_direction = direction;

        if ((direction == NORTH) || (direction == WEST)) {
            op_cell = cell.around(direction);
            op_direction = (direction == NORTH ? SOUTH : EAST)
        }

        if (op_cell.children('.'+op_direction+'.selected').length > 0) {
            return direction;
        }        
    };

    this.isLeaf = function() {
        return this.hasClass('leaf') || this.hasClass('extended_leaf');
    };

    this.isJustLeaf = function() {
        return this.hasClass('leaf');
    };

    this.isExtendedLeaf = function() {
        return this.hasClass('extended_leaf');
    };

    this.isDeadEnd = function() {
        return this.hasClass('js-dead-end');
    };

    this.markDeadEnd = function() {
        this.addClass('js-dead-end dead_end');
        return this;
    };

    this.toJoint = function (start, end) {
        // curved joint
        if(start.slice(-2) != end.slice(-2)) {
            cell.append("<div class='planks'><div class='plank'></div><div class='plank'></div><div class='plank'></div></div>");
        }

        //  where_to_where
        var path = start + '_to_' + end;
        cell.addClass(path);
        cell.addClass('joint');
        this.addClass('extension');  
    };

    return $.extend(this, cell.element().find('.node'));
}


// board - what board is the tree going to grow on?
// root - where will the tree start growing?
// height - how tall is the tree going to be?
// probablity(of extension) - how lengky is the tree going to be?
function Tree(board, root, height, probability, ext_root) {

    if(!board || !root) {
        return null;
    }

    if(!probability || probability < 0 || probability > 100) {
        probability = 50;
    }

    height = height || 3;
    ext_root = ext_root || 0;

    var leaves = [];
    var counter = 0;
    var ids = [];

    root.addClass('root js-root');

    this.board = function() {
        return board;
    }

    this.root = function() {
        return root;
    }

    this.height = function() {
        return height;
    }

    this.probability = function() {
        return probability;
    }

    this.leaves = function() {
        return leaves;
    }

    this.ids = function() {
        return ids;
    }

    this.counter = function() {
        return counter;
    }

    this.incrementCounter = function() {
        counter++;
    }

    // calls branch on the list of given nodes, returns the next list of newly created nodes
    // this function is used to grow the tree level order, using recursion makes the tree lopsided
    function branchMany(nodes) {

        var new_nodes = [];
        
        for (var i = 0; i < nodes.length; i++) {
            // note you can call branch on a node            
            var result = nodes[i].branch(2, i == 0 ? 0 : probability);
            new_nodes = new_nodes.concat(result);
        }
    
        return new_nodes;
    }

    this.growLevelOrder = function () {        
        var nodes = root;

        for (var i = 0; i < ext_root; i++) {            
            nodes = nodes.extend2();
        }

        nodes = [nodes];
    
        for (var i = 0; i < height; i++) {            
            nodes = branchMany(nodes);
        }

        $.each(nodes, function (index, node) {
            id = index + 1;

            // 6 and 9 look alike, so I'm changing them to letters
            if(id == 4) {
                id = '​‌G';
            } else if(id == 6) {
                id = 'Ж';
            } else if(id == 9) {
                id = 'H';
            } else if(id == 11) {
                id = '​‌ƕ';
            }
            ids.push(id);
            node.addClass('leaf').id(id);            
        });

        leaves = nodes;

        return leaves;
    };
}
;
// node - the leaf node to change into a house
// direction - the orientaion of the house
function House(node, direction, color) {

    var colors = ['red', 'white', 'brown'];

    if (!color || !colors.includes(color)) {
        var rand_num = Math.floor((Math.random() * 100) + 1);
        var color = rand_num < 10 ? 'white' : (rand_num > 90 ? 'red' : '');
    }

    // house html
    var house = '<div class="house '+direction+' '+color+'"><div class="front"><div class="tunnel"></div></div><div class="side">'+node.id()+'</div><div class="roof"></div></div>';

    // the south house is a special case, it looks weird visually, so it gets converted into an EAST house
    if(direction == SOUTH) {
        node.cell().addClass(EAST);
        node.removeClass('leaf').addClass('extended_leaf');
        node.siblings('.east.edge').addClass('selected shorter');
        node.toJoint(NORTH, EAST);
    }

    node.cell().append(house);
}
;
// destination and speed don't change during the lifetime of a train
function Train(destination, speed) {
  var train = "<div class='train'><div class='pilot'><div class='destination js-destination'>"+destination+"</div></div><div class='stack'></div><div class='engine'></div><div class='wheels'><div class='wheel'><div class='spoke'></div><div class='spoke'></div><div class='spoke'></div><div class='spoke'></div></div><div class='wheel'><div class='spoke'></div><div class='spoke'></div><div class='spoke'></div><div class='spoke'></div></div><div class='wheel'><div class='spoke'></div><div class='spoke'></div><div class='spoke'></div><div class='spoke'></div></div></div></div>";
    var station = null;
    var status = "";
    var max_time = 1000;

    this.setStatus = function() {
        if(destination == station.id()) {
            status = "GOOD";
        } else if(station.isDeadEnd()) {
            status = "UGLY";
        } else {
            status = "BAD";
        }        
    };

    // advance the train one node
    this.advance = function(node) {

        if(node == null) {
            return null;
        }

        // what direction is the train going in?
        var direction = node.selected();

        if (!direction) {
            // there is nowhere to go!
            return null;
        }

        var j_train = $(train).addClass('to_' + direction)
             .css('animation-name', 'to_' + direction)
             .css('animation-duration', (speed * .8) + 's');

        // train is set up, where do we put it?

        // SOUTH and EAST go in this cell
        var op_node = node;
        var op_cell = node.cell();

        // this is for later
        var next_node = null;

        // NORTH and WEST go in adjacent cells
        switch (direction) {
            case NORTH:
            case WEST:
                op_cell = op_cell.around(direction);
                op_node = new Node(op_cell);
                break;
        }

        // add the train
        op_cell.append(j_train);
        j_train = $('.train', op_cell);

        /* PART 2 - WHERE WE ARE GOING NEXT */

        // how long the train will be on the board, although the animation will change
        // at the 80% mark
        // trains at leaves don't have turns and will be remove from the board sooner


        if (op_node.isExtendedLeaf()) {
            // then there is no next node and may not even be a next cell            
            max_time = 90;
            next_node = null;
            station = op_node;
        } else {
            // find the next node for the turn and return it
            // if NORTH or WEST we already found it above
            // if SOUTH or EAST do what NORTH and WEST did
            switch (direction) {
                case SOUTH:
                case EAST:
                    next_cell = op_cell.around(direction);
                    next_node = new Node(next_cell);
                    break;
                case NORTH:
                case WEST:
                    next_cell = op_cell;
                    next_node = op_node;
                break;
            }

            if (next_node.isJustLeaf() || (next_node.isDeadEnd())) {

                if ((next_node.isJustLeaf() && next_cell.hasClass('west')) || (next_node.isDeadEnd())) {
                    max_time = 370;
                } else {
                    max_time = 750;
                }
                station = next_node;
                next_node = null;
            } else {                
                // at the 80% mark change the animation to turn
                // remember leaves don't turn
                setTimeout(function () {
                    var to = next_node.selected();
                    j_train.css('animation-name', direction + '_to_' + to)
                           .css('animation-duration', (speed * .2) + 's');
                }, speed * 800);
            }
        }

        setTimeout(function () {
            j_train.remove();
        }, speed * max_time);

        return next_node;
    };

    this.traverse = function(starting_node) {
        var node = starting_node;
        var self = this;

        last_node = (function theLoop(node, id) {

            var next_node = self.advance(node);

            if(next_node) {
                setTimeout(function () {
                    last_node = theLoop(next_node);
                    if(last_node) {
                        station = last_node;                        
                    }
                }, speed * 1000);
            } else {
                self.setStatus();
                // global variable bad
                if (game) {
                    game.handleScore(status, station.cell(), speed * (max_time - 100));
                }                
                return station;
            }
        })(node);
    };
}
;
$(document).on('click', '.js-instructions', function () {    
    html = "<div class='instructions-box'><div class='instructions'> " +
        "<h2>INSTRUCTIONS</h2>" +
        "Trains will emerge from the bright green circle. " +
        "Matching the train number and the station number, " +
        "guide the trains to the right stations by changing the tracks along their way. " +
        "Change tracks by clicking on the blue circles on the joints. Keep up, more and more trains will emerge with varying speeds. " +
        "As you progress the map will expand and the trains will quicken." +
        "</div></div>";

    addOverlay(html, "");
});

$(document).on('click', '.js-close-overlay, .overlay, .js-continue', function () {
    $('.overlay, .overlay-box').remove();
    $('.gamewrapper').removeClass('faded');
});

function addOverlay(html, selector) {
    $('.gamewrapper').addClass('faded');
    $('body').append("<div class='overlay'></div><div class='"+selector+" js-overlay-box overlay-box'><p class='js-close-overlay'><span class='close'>X</span></p></div>");
    $('.js-overlay-box').append(html);
}

function setGame(difficulty) {    
    game = new Game(difficulty);
    game.draw();
}

$(document).on('click', '.js-play', function () {
    $(this).attr('disabled', true).html('OK!');
    setGame(difficulty);
});

$(document).on('click', '.js-change_map', function () {
    setGame(difficulty);
});

$(document).on('click', '.js-start', function () {
    this.remove();
    $('.js-settings').hide();
    game.startGame();
});

$(document).on('click', '.js-continue', function () {
    if(game.success()) {
        difficulty+=1;
    }
    setGame(difficulty);
});

$(document).on('click', '.js-harder, .js-easier', function () {
    difficulty = parseInt($('.js-level').html());

    $(this).hasClass('js-harder') ? difficulty+=1 : difficulty-=1;

    if (difficulty < game.minDifficulty()) {
        difficulty = game.minDifficulty();
    } else if(difficulty > game.maxDifficulty()) {
        difficulty = game.maxDifficulty();
    }

    $('.js-level').html(difficulty);
    $('.js-change_map').addClass('blink');
});

// click handler for changing tracks    
$(document).on('click', '.node', function () {
    var i = $(this).parent().index() + 1;
    var c = game.board().cell(i);
    var n = new Node(c);
    n.switchTracks();
});

// trying to improve performance
$(window).scroll(function() {
    var scroll = $(document).scrollTop();
    if(scroll > 100) {
        $('.cloud').css('animation-play-state','paused');
    } else {
        $('.cloud').css('animation-play-state','running');
    }
});
 
/* -- WINDY -- */
function windyDay() {
    $('.tree').addClass('blown');
    setTimeout(function () {
        $('.tree').removeClass('blown')
    }, 1000);
}

(function loop() {
    var rand = Math.floor((Math.random() * 7) + 2);
    setTimeout(function() {
            windyDay();
            loop();  
    }, rand * 1000);
}());
function Game(difficulty) {

  var score = chain = 0;
    var correct = total = 0;
    var deaths = 0;

    var complete = false;
    var success = false;

    var board;
    var tree;

    var ids = [];
    var sequence = [];

    var max_difficulty = 9;
    var min_difficulty = 1;

    var height = 0;
    var delta = 1; // how far sequential train stations must be, prevents collisions, minimum must be 1
    var ext_root = 1; // extend the root, helpful for higher levels with fast trains
    var speed = interval = []; // speed of train in seconds, interval how many seconds to wait before sending the next
    var death_probability = 0; // likelihood of death 0 to 100
    var death_timer = 0; // the time limit before death nodes revert back to death
    var ext_probability = 0; // the probablity 1 to 100 of extending branches, makes a lenkier tree
    var max_death = 2; // max on purpose deaths on board, meaning it does not count dead ends
    var trains = 0; // how many trains to deploy

    // check input
    if(difficulty == null) {
        difficulty = 3;
    } else if(difficulty > max_difficulty) {
        difficulty = max_difficulty;
    } else if(difficulty < min_difficulty) {
        difficulty = min_difficulty;
    }

    // the only difficulties accepted
    // note when there are multiple speeds train collisions may occur, each train is a linear function
    // to find collisions...solve for x / the point of intersection between 2 lines, x is time to collision
    // divide by slowest train speed to find minimum tree height required for collision
    // use delta to prevent collisions, delta is the distance between stations, the sooner trains are on
    // different tracks, it becomes impossible for them to collide
    switch(difficulty) {
        case 1:
            height = 2;
            trains = 8;
            death_probability = 0;
            death_timer = 0;
            ext_probability = 0;
            
            speed = [4]; // single speed - collisions are impossible
            interval = [3, 2, 2, 2];            
            break;
        case 2:
            height = 2;
            trains = 10;
            death_probability = 5;
            death_timer = 18;
            ext_probability = 75;
            /*
            y = 4x
            y = 3x + 2
            4x = 3x + 2
            x = 2
            y = 8
            collision will occur in 8 seconds, on 4th node
            but on a tree of height 2 with a max ext 2, this is impossible
            */
            speed = [4, 3];
            interval = [2];
            break;
        case 3:
            height = 3;
            trains = 10;
            death_probability = 5;
            death_timer = 15;
            ext_probability = 50;
                        
            speed = [3]; // single speed - collisions are impossible
            interval = [3, 2.5, 2];
            break;
        case 4:
            height = 3;
            trains = 12;
            death_probability = 10;
            death_timer = 12;
            ext_probability = 30;        
            /*
            y = 3x
            y = 2.5x + 1.5
            3x = 2.5x + 1.5
            x = 3
            y = 9
            collision will occur in 9 seconds, on 4.5 (7.5) th node           
            on a tree of height 3, max height is 5, so collions are very rare
            */            
            speed = [3, 2.5];
            interval = [3, 2.5, 2, 1.5];
            break;
        case 5:
            height = 3;
            ext_root = 2;
            trains = 12;
            death_probability = 10;
            death_timer = 8;
            ext_probability = 30;
            delta = 2; // collisions impossible
            
            speed = [2.5, 2];
            interval = [2, 1.5];
            break;
        case 6:
            height = 4;
            ext_root = 2;
            trains = 12;
            death_probability = 10;
            death_timer = 8;
            ext_probability = 75;
            delta = 4;
            /*
            y = 3x
            y = 2x + 2
            3x = 2x + 2
            x = 2           
            y = 6
            collision will occur in 6 seconds, on 4th node
            max height is 9
            */
            speed = [3, 2];
            interval = [2.5, 2];
            break;
        case 7:
            height = 4;
            ext_root = 2;
            trains = 16;
            death_probability = 15;
            death_timer = 5;
            ext_probability = 75;
            delta = 4;
            /* 
            y = 3x
            y = 2x + 3
            3x = 2x + 3
            x = 3
            y = 9
            collision will occur in 9 seconds, on 6th node
            */
            speed = [3, 2.5, 2];
            interval = [3];
            break;
        case 8:
            height = 5;
            ext_root = 3;
            trains = 16;
            death_probability = 0; // there already alot of dead ends
            death_timer = 5;
            ext_probability = 75;
            
            speed = [2]; // collisions impossible
            interval = [3];
            break;            
        case 9:
            height = 5;
            ext_root = 2;
            trains = 16;
            death_probability = 0; // there already alot of dead ends
            death_timer = 3;
            ext_probability = 75;
            
            speed = [2]; // any faster is just cruel, collisions impossible
            interval = [3, 3, 2, 1.5];
            break;
    }

    // clear the html score
    $('.js-score, .js-correct, .js-total').html(score);

    
    this.board = function() {
        return board;      
    };
    
    this.tree = function() {
        return tree;      
    };

    this.success = function() {
        return success;      
    };

    this.difficulty = function() {
        return difficulty;
    };

    this.maxDifficulty = function() {
        return max_difficulty;
    };

    this.minDifficulty = function() {
        return min_difficulty;
    };

    this.complete = function(value) {        
        return complete;      
    };

    this.deathTimer = function() {
        return death_timer;      
    };

    this.finished = function() {
        deaths /= 2;
        correct -= deaths;
        var accuracy = parseInt((correct/total) * 100);        
        var html = message = "";

        if(accuracy == 100) {
            headline = '<span style="color: rgb(160, 212, 104);">G</span><span style="color: rgb(79, 193, 233);">R</span><span style="color: #ED5565;">E</span><span style="color: rgb(255, 206, 84);">A</span><span style="color: rgb(140, 193, 82);">T</span>&nbsp;<span style="color: rgb(252, 110, 81);">J</span><span style="color: rgb(93, 156, 236);">O</span><span style="color: rgb(236, 135, 192);">B</span>';
            message = "You got all the trains to the right station!";
            success = true;
        } else if(accuracy >= 80) {
            headline = '<span style="color: rgb(252, 110, 81);">G</span><span style="color: #ED5565;">O</span><span style="color: rgb(140, 193, 82);">O</span><span style="color: rgb(93, 156, 236);">D</span>&nbsp;<span style="color: #967ADC;">J</span><span style="color: rgb(55, 188, 155);">O</span><span style="color: rgb(74, 137, 220);">B</span>';
            message = "You're ready for the next level.";
            success = true;
        } else {
            headline = "<span>Y</span><span>I</span><span>K</span><span>E</span><span>S</span>";
            message = "Not enough trains made it to their destinations.";
            success = false;
        }

        html = "<div><div class='headline'>"+headline+"</div><div class='accuracy'>Accuracy "+accuracy+"%</div><p class='message'>"+message+"</p><button class='js-continue centered'>CONTINUE</button></div>";    
        addOverlay(html, 'ending-overlay');
        $('.js-settings').show();

        complete = true;
    };

    this.handleScore = function(status, cell, wait) {
        var points = this.calculatePoints(status);
        this.updateScore(points);

        var self = this;
        setTimeout(function () {
            self.animateScore(points, cell);    
        }, wait);
        
        // display overlay
        if(total == sequence.length) {
            setTimeout(function () {
                game.finished();
            }, 800);
        }
    };

    this.calculatePoints = function(status) {
        var points = -10;
        var bonus = 0;
        var old_chain = chain;
        
        if (status == "GOOD") {
            points = 10;
        } else if (status == "UGLY") {
            points = -25;
            deaths += 1;
        }

        points > 0 ? chain += 1 : chain -= 1;
        
        if(Math.abs(old_chain) > Math.abs(chain)) {
            // if chain is broken, reset chain and set bonus to 0
            chain = points > 0 ? 1 : -1;
            bonus = 0;

        } else if(Math.abs(chain) >= 3) {
            bonus = (Math.abs(chain) - 2) * 3;

            // the max bonus is 15
            bonus = bonus > 16 ? 15 : bonus;

            if(points > 0) {
                points += bonus;
            } else {
                points -= bonus;
            } 
        }

        return points;
    };

    this.updateScore = function(points) {
        total += 1;
        $('.js-score').html(score += points);
        if (points > 0) {
            $('.js-correct').html(correct += 1);
        }
    };

    this.animateScore = function(points, cell) {
        var puff = "puff_" + Math.floor((Math.random() * 3) + 1);
        var color = "red";

        if(points > 0) {
            points = "+"+points;
            color = "";
        }

        cell.append("<div class='chewy rise "+puff+ " " +color+"'>"+points+"</div>");
    }

    this.draw = function() {
        board = new Board();
        var cell = board.cell(1);
        var node = new Node(cell).render();
        tree = new Tree(board, node, height, ext_probability, ext_root);
        var leaves = tree.growLevelOrder();
        tree.root().cell().append('<div class="js-settings"><button class="js-start start">START</button><button class="js-change_map change_map">CHANGE MAP</button><div class="difficulty"><button class="js-easier">-</button><div class="level">LEVEL <span class="js-level">'+difficulty+'<span></div><button class="js-harder">+</button></div></div>');
        var death_count = 0;

        // convert leaf nodes to houses
        for (var i = 0; i < leaves.length; i++) {
           
            // direction of house, ugh, just so the naming is more intuitive
            var direction = flipDirection(leaves[i].parentDirection());

            var rand_num = Math.floor((Math.random() * 100) + 1);

            if((rand_num < death_probability) && (death_count < max_death)) {
                new Death(leaves[i]);
                death_count++;
            } else {
                new House(leaves[i], direction);
                ids.push(leaves[i].id());
            }
        }

        this.decorate(Math.pow(2, height));        
    };

    this.decorate = function(num) {
        var cells = board.width() * board.height();

        for (var i = 0; i < num; i++) {
            var rand_num = Math.floor((Math.random() * cells) + 1);
            var cell = board.cell(rand_num);
            var tree = '<div class="tree"><div class="branch"></div><div class="branch"></div><div class="trunk"></div><div class="shadow"></div></div>';
        
            // normalized x and y values, full range for an empty cell
            var minX = 0;
            var maxX = 92;

            var minY = 0;
            var maxY = 34;
            
            // ugh 2 challenging problems collision detection and overlap correction

            // prevent overlapping edges
            if (cell.hasClass(EAST) || cell.hasClass(WEST)) {
                maxY = 10;
            }

            if (cell.hasClass(NORTH) || cell.hasClass(SOUTH)) {
                minX = 24;
            }      

            // prevent overlapping houses            
            if ((cell.children('.house.south').length > 0) || (cell.children('.house.west').length > 0)) {
                maxY = 22;
            }

            // every x is free!
            var randX = Math.floor( (Math.random() * ((maxX + 1) - minX)) + minX);

            // but y may have restrictions
            if (cell.children('.house.north').length > 0) {
                if (randX > 23 && randX < 61) {
                    maxY = 16;
                } else {
                    maxY = 78;
                }   
            }

            if (cell.children('.house.east').length > 0) {
                if (randX >= 0 && randX < 67) {
                    maxY = 22;
                } else {
                    maxY = 86;
                }                
            }

            var randY = Math.floor((Math.random() * ((maxY + 1) - minY)) + minY);
            
            randX -= 4;
            randY -= 22;
            randY *= -1;
        
            var zIndex = 3;
            var south_cell = cell.around(SOUTH);
            
            if((south_cell) && (south_cell.children('.house').length > 0)) {
                zIndex = 0;
            }
            
            tree = $(tree).css('left', randX).css('top', randY).css('z-index', zIndex);
            cell.append(tree);            
        }
    }

    // generateSequence: generate of sequence of trains to play, a train needs a destination and speed.
    // the game will deploy the trains at intervals    
    // returns - an array like [ [speed, interval, destination], ..... ]
    this.generateSequence = function() {
        sequence = [];
        var length = ids.length;

        for (var n = 0; n < trains; n++) {

            // randomly generate speed, interval, destination
            // interval is the number of hops to wait before sending out the next train
            var s = speed[Math.floor(Math.random() * speed.length)];            
            var i = interval[Math.floor(Math.random() * interval.length)];
            var r = Math.floor(Math.random() * length);
            var d = ids[r];

            // move this delta to the back of the array
            var start = Math.floor(r/delta) * delta;
            var piece = ids.splice(start, delta);
            ids = ids.concat(piece);
            
            // first interval should be 0, meaning the game starts immediately
            if (n == 0) {
                i = 0;
                length -= delta;
            }

            sequence.push([s, i, d]);
        }

        return sequence;
    }

    // starts the game, game.draw() needs to be called before
    this.startGame = function() {
        // create game play
        this.generateSequence();
        $('.js-total').html(sequence.length);
        // let's begin
        (function theLoop(i) {

            setTimeout(function () {        
                // [2] is destination, [0] is speed
                train = new Train(sequence[i][2], sequence[i][0]);            
                train.traverse(tree.root());

                if (++i < sequence.length) {
                    theLoop(i);
                }                
            }, sequence[i][1] * sequence[i][0] * 1000);

        })(0);
    };

    this.idle = function() {
        var board = new Board();
        var cell = board.cell(1);
        var root = new Node(cell).render();
        var node = root.addClass('root js-root').extend2(EAST).extend2(EAST);        
        var nodes = node.branch([EAST, SOUTH]);       
        new House(nodes[0].addClass('leaf'), EAST, 'brown');
        var nodes = nodes[1].branch([EAST, SOUTH]);

        node = nodes[0].extend2(EAST).extend2(NORTH).extend2(EAST).extend2(EAST);
        new House(node.addClass('leaf'), EAST, 'red');

        nodes = nodes[1].branch([EAST, WEST]);
        node = nodes[1].extend2(WEST).extend2(NORTH);

        new House(node.addClass('leaf'), NORTH, 'white');

        node = nodes[0].extend2(EAST);
        new House(node.addClass('leaf'), EAST, 'brown');

        board.addTree(6, -8, -42, 0);
        board.addTree(11, 50, 16, 0);

        board.addTree(8, 40, 4, 0);        
        board.addTree(9, 40, -50, 0);

        board.addTree(3, 65, 14, -3);
        board.addTree(3, 65, 14, 3);
        board.addTree(3, 50, 14, 3);

        board.addTree(4, 12, 14, 4);

        board.addTree(4, 42, -60, 3);

        board.addTree(13, 60, 5, 3);
        board.addTree(14, 50, 35, 3);

        var train = new Train('',2);
        train.traverse(root);
    };
}
;
function Death(node) {    
    var death = '<div class="death"><div class="head"><div class="skull"><div class="eyes"><div class="eye eye-left"></div><div class="eye eye-right"></div></div></div></div><div class="body"></div><div class="legs"></div></div>';
    node.markDeadEnd().cell().append(death);
    
    var parent = node.parentNode();    
    parent.click();
}
;
$(document).on('click', '.js-tutorial', function () {
    $(this).attr('disabled', true).html('IN PROGRESS...');
    $('.js-play').attr('disabled', true).html('----');

    setGame(difficulty=2);

    $('.js-settings').hide();
    $('html, body').animate({scrollTop: '190'}, 1000);


    $('.cell').addClass('faded');
    $('.root').parent().removeClass('faded').children().addClass('faded');

    
    $('.root').parent().append('<div class="tutorial_message">Guide the trains to the right stations.</div>');


    setTimeout(function () {
        $('.tutorial_message').css('width', '4em').html("Trains will start here. ↓");        

        $('.root').addClass('radiate');
    }, 4000);


    setTimeout(function () {

        $('.tutorial_message').remove();

        $('.root').siblings().removeClass('faded');

        var direction = game.tree().root().selected();
        if((direction == NORTH) || (direction == WEST)) {
            game.tree().root().cell().around(direction).removeClass('faded');    
        }
        
        train = new Train(1,3);
        train.advance(game.tree().root());
    }, 10000);

    setTimeout(function () {
        train = new Train(1,3);
        train.advance(game.tree().root());
    }, 13000);

    setTimeout(function () {
        train = new Train(1,3);
        train.advance(game.tree().root());      
    }, 16000);


    setTimeout(function () {
        $('.root').removeClass('radiate');

        $('.node').not('.root, .extension').addClass('pulse');

        $('.cell').removeClass('faded');

        $('.cell > div').not('.node').addClass('faded');
        $('.extension').addClass('faded');
        
        $('.root').parent().append('<div class="tutorial_message">Click on the joints to switch the direction of the train tracks.</div>');
    }, 19000);



    setTimeout(function () {
        $('.node').removeClass('pulse').addClass('faded');
        $('.tutorial_message').html('Good luck! As you progress the map will expand and the trains will quicken.').css('width', '11em');
    }, 26000);


    setTimeout(function () {
        $('.js-tutorial').attr('disabled', false).html('TUTORIAL');
        $('.tutorial_message').remove();
        $('.js-settings').show();
        $('.cell > div').removeClass('faded');        

        $('.js-play').html('OK!');
    }, 30000);

});

var game = null;
var difficulty = 3;

$(function() {
      game = new Game(difficulty);
      game.idle();
  $('.uk-height-viewport').fadeOut(2800, function(){this.remove();});

});
</script>
    </body>
</html>
