var state = 0;
var board = undefined;
var shipsToPlace = 5;
var up = false; 
var boardwidth = 10;
var boardheight = 10;
var placestate = 0;
var currentselect;
function elem(id) {
    return document.getElementById(id);
}

function sendRequest(to) {
    return new Promise((resolve, reject) => {
    fetch(to).then(b=>b.json().then((res) => {
        resolve(res);
    }))
    })
}
function createTable(tableData) {
const alphabet = Array.from(Array(26)).map((e, i) => i + 65).map((x) => String.fromCharCode(x));
      var table = document.createElement('table');
      table.className = "table table-bordered"
      table.id = "placeBoard";
      var row = {};
      var cell = {};
    var counter = 0;
    row = table.insertRow(-1)
            blankcell = row.insertCell();
        blankcell.textContent = " "
    tableData[0].forEach(function() {
        counter++
         numcell = row.insertCell();
        numcell.textContent = counter;
    })
    counter = 0;
    var counterx = 0;
      tableData.forEach(function(rowData) {
          counterx = 0;
        row = table.insertRow(-1);
        alphacell = row.insertCell();
        alphacell.textContent = alphabet[counter]
        rowData.forEach(function(cellData) {

          cell = row.insertCell();
    			cell.textContent = cellData;
                cell.className = "placeCell";
                cell.id = new Position(counterx, counter).asString
                counterx++
        });
        counter++
      });
      elem("main").appendChild(table);
    }
    function tableListener() {
            var table = document.getElementById("placeBoard");
    if (table != null) {
        for (var i = 0; i < table.rows.length; i++) {
            for (var j = 0; j < table.rows[i].cells.length; j++)
            table.rows[i].cells[j].onclick = function () {
                if(this.classList.contains("placeCell")) {
                    placeCellClick(new Position(this.id));
                }
            };
        }
    }

    }

    function getShipLetter(num) {
        if(num == 5) {
            return "a";
        } else if(num == 4) {
            return "b";
        } else if(num == 3) {
return "c";
        } else if(num == 2) {
return "d";
        } else {
return "e";
        }
    }

    function getShipLength(num) {
                if(num == 5) {
            return 5;
        } else if(num == 4) {
            return 4;
        } else if(num == 3) {
return 3;
        } else if(num == 2) {
return 3;
        } else {
return 2;
        }
    }

function checkPlaceShip(ship) {
    isPlaceable = true;
    var cc = 0;
            ship.getPoints().forEach((point) => {
            if(point.x > boardwidth-1 || point.x < 0 || point.y < 0 || point.y > boardheight-1 ) {
                isPlaceable = false
                }
                cc++
        })
        return isPlaceable;
}
    function placeCellClick(pos) {
        if(placestate == 0 ||placestate == 1) {
            elem("confirm").disabled = false
            elem("cancel").disabled = false
            if(currentselect) {
                elem(currentselect.asString).innerHTML = " ";
            }
            //check if click area is already taken
            if(elem(pos.asString).innerHTML == " ") {
                elem(pos.asString).innerHTML = getShipLetter(shipsToPlace);
                elem("confirm").innerHTML = "Down"
                elem("cancel").innerHTML = "Right"
                                elem("confirm").style.display = ""
                elem("cancel").style.display = ""
                var downship = new Ship(pos, getShipLength(shipsToPlace), true);
                var rightship = new Ship(pos, getShipLength(shipsToPlace), false);
                if(!checkPlaceShip(downship)) {
                    console.log("ffff")
                    elem("confirm").disabled = true
                }
                if(!checkPlaceShip(rightship)) {console.log("ffdff")
                    elem("cancel").disabled = true
                    }
                currentselect = pos;
                placestate = 1;
            }
        } 



        //console.log(pos)
        /*
        var isPlaceable = true;
        ship = new Ship(pos, 5, true);
        if(ship.getPoints()) {
        ship.getPoints().forEach((point) => {
            if(point.x > boardwidth || point.x < 0 || point.y < 0 || point.y > boardheight) {
                isPlaceable = false
                }
        })
        if(isPlaceable) {
                    ship.getPoints().forEach((point) => {
                        //console.log(point);
          elem(point.asString).innerHTML = "a"  
        })
        }
        
        } */
    }
function reconnect() {
    elem("text-main").innerHTML = "Reconnect Feature priority: low"
}
function err(e) {
elem("text-main").innerHTML = "Unexpected Error!<br>Check console for detailed info"
console.log(e)
}

elem("confirm").onclick = function() {
    if(placestate == 1) {
        //right

        var ship = new Ship(currentselect, getShipLength(shipsToPlace), true)
   ship.getPoints().forEach((point) => {
                        //console.log(point);
          elem(point.asString).innerHTML = getShipLetter(shipsToPlace);  
        })
        placestate = 2;
    } else if(placestate == 2) {



    }
}
elem("cancel").onclick = function() {
    if(placestate == 1) {
        //right
        var ship = new Ship(currentselect, getShipLength(shipsToPlace), false)
   ship.getPoints().forEach((point) => {
                        //console.log(point);
          elem(point.asString).innerHTML = getShipLetter(shipsToPlace);  
        })
        placestate = 2;
    } else if(placestate == 2) {

    }
}

var gameId = sessionStorage.getItem('gameId');
var playerId = sessionStorage.getItem('playerId');
//if(gameId && playerId) {
 //reconnect()
//} else {
    elem("text-main").innerHTML = "Creating a new game..."
    sendRequest("../api/new_game.php?type=playervscomputer").then((create) => {
        if(create.success) {
                elem("text-main").innerHTML = "Storing game data..."
                sessionStorage.setItem("gameId", create.id);
                sessionStorage.setItem("playerId", create.playerId)
                 gameId = sessionStorage.getItem('gameId');
                 playerId = sessionStorage.getItem('playerId');
                elem("text-main").innerHTML = "Retrieving game board.."
                sendRequest("../api/get_board.php?id="+gameId+"&playerId="+playerId).then((boardInfo) => {
                    if(boardInfo.success) {                  
                        elem("text-main").innerHTML = "Place your ships<br>"
                        elem("text-secondary").innerHTML = "Currently placing: Battleship (Length 5)<br>5 more ships to go!<br><br>";
                        board = boardInfo.board;
                        boardwidth = board[0].length;
                        boardheight = board.length;
                        console.log(boardwidth, boardheight);
                        createTable(board)
                        tableListener()
                    } else {
elem("text-main").innerHTML = "Failed fetching board!<br><br>"+boardInfo.errormsg;
                    }
                }).catch(err)
        } else {
            elem("text-main").innerHTML = "Failed creating game!"
        }
    }).catch(err)
//}
