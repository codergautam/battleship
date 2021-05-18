var state = 0;
var board = undefined;
var shipsToPlace = 5;
var up = false; 
var boardwidth = 10;
var boardheight = 10;
var placestate = 0;
var currentselect;
var isUp;
var shipStart;
var placing = true;
var gameId = sessionStorage.getItem('id');
var playerId = sessionStorage.getItem('playerId');var state = 0;
var turn = true;
var waitingforopponent = false;
var serverResponded = true;
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
function createTable(tableData, enemy) {
const alphabet = Array.from(Array(26)).map((e, i) => i + 65).map((x) => String.fromCharCode(x));
      var table = document.createElement('table');

      table.className = "table table-bordered"
      table.id = (enemy?"enemyBoard":"placeBoard");
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
                cell.className = (enemy?"enemyCell":"placeCell");
                cell.id = new Position(counterx, counter).asString+(enemy?"e":"")
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

    function enemyListener() {
                    var table = document.getElementById("enemyBoard");
    if (table != null) {
        for (var i = 0; i < table.rows.length; i++) {
            for (var j = 0; j < table.rows[i].cells.length; j++)
            table.rows[i].cells[j].onclick = function () {
                if(this.classList.contains("enemyCell")) {
                    enemyCellClick(new Position(this.id.slice(0,-1)));
                }
            };
        }
    }
    }

    function colorCells(arr, enemy) {
        arr.forEach(function(cellLoc) {
            if(enemy) {
                var cell = elem(cellLoc+"e");
                 cell.style.backgroundColor = "red";
            } else {
                var cell = elem(cellLoc)
                cell.style.backgroundColor = "lime";
            }
        })
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
    function getShipName(num) {
        if(num == 5) {
            return "Carrier";
        } else if(num == 4) {
            return "Battleship";
        } else if(num == 3) {
return "Cruiser";
        } else if(num == 2) {
return "Submarine";
        } else {
return "Destroyer";
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
            if(point.x > boardwidth-1 || point.x < 0 || point.y < 0 || point.y > boardheight-1 || (elem(point.asString).innerHTML != " " && elem(point.asString).innerHTML != getShipLetter(shipsToPlace))) {
                isPlaceable = false
                }
                cc++
        })
        return isPlaceable;
}
    function placeCellClick(pos) {
        if(!placing) return 
        if(document.getElementById(pos.asString).innerHTML == " ") {
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
                    elem("confirm").disabled = true
                }
                if(!checkPlaceShip(rightship)) {
                    elem("cancel").disabled = true
                    }
                currentselect = pos;
                placestate = 1;
            }
        }
        } 
    } 

    function enemyCellClick(pos) {
        if(serverResponded) {
        if(state == 1) {
        if(turn) {
            if (elem(pos.asString+"e").innerHTML == " ") {
            sendRequest(`../api/hit.php?id=${gameId}&playerId=${playerId}&pos=${pos.asString}`)
            .then((hitData)=>{
                if(hitData.success) {
                    elem(pos.asString+"e").innerHTML = "⌛"
                    serverResponded = false;
                } else {
                   // alert(hitData.errormsg)
                }
            }).catch(err)
            }
        }
        }
        }
    }

function updateEnemyBoard(arr) {
    arr.forEach(function(row, ir) {
        row.forEach(function(cell, ic) {
                       theElem = elem(new Position(ic, ir).asString+"e");
            theElem.innerHTML = (cell == "X" ? "💥" : cell);
            if(cell == "X") theElem.style.backgroundColor = "lime";
        })
    })
}
function updateBoard(arr) {
    arr.forEach(function(row, ir) {
        row.forEach(function(cell, ic) {
            theElem = elem(new Position(ic, ir).asString)
            theElem.innerHTML = (cell == "X" ? "💥" : cell);
            if(cell == "X") theElem.style.backgroundColor = "red";
        })
    })
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
        //up
    
        var ship = new Ship(currentselect, getShipLength(shipsToPlace), true)
        shipStart = ship;
        isUp = true;
   ship.getPoints().forEach((point) => {
                        //console.log(point);
          elem(point.asString).innerHTML = getShipLetter(shipsToPlace);  
        })
                elem("cancel").disabled = false
        elem("confirm").disabled = false
        elem("confirm").innerHTML = "Confirm";
        elem("cancel").innerHTML = "Cancel";
        placestate = 2;
    } else if(placestate == 2) {
        elem("confirm").disabled = true;
        elem("cancel").disabled = true;
sendRequest(`../api/place_ship.php?id=${gameId}&playerId=${playerId}&up=${isUp?"1":"0"}&pos=${shipStart.starting.asString}&length=${getShipLength(shipsToPlace)}`)
.then((placeData) => {
    if(placeData.success) {
        placestate = 0;
        elem("confirm").disabled = false;
        elem("cancel").disabled = false;
        elem("confirm").style.display = "none";
        elem("cancel").style.display = "none";
        shipsToPlace -= 1;
        currentselect = undefined;
        if(shipsToPlace == 0) {
            sendRequest(`../api/done_placing.php?id=${gameId}&playerId=${playerId}`)
.then((doneData) => {
    if(doneData.success) {
        if(doneData.waitforenemy) {
            waitingforopponent = true;

$("#text-main").html("Waiting for opponent to place ships..")
        } else {
        placing = false;
        elem("text-main").innerHTML = ""
        elem("text-secondary").innerHTML = ""

        state = 1;
    sendRequest("../api/get_enemy_board.php?id="+gameId+"&playerId="+playerId).then((enemyBoardData) => {
         if(enemyBoardData.success) {
             createTable(enemyBoardData.board, true);
                     enemyListener()
                     $("#placeBoard").show();
                     $("#enemyBoard").appendTo("#row");
                     $("#placeBoard").prependTo("#row");
                     elem("placeBoard").className = "table table-bordered col-md-6"
                     elem("enemyBoard").className = "table table-bordered col-md-6"
                      elem("rfow").style.display = "";
         } else {
             alert(enemyBoardData.errormsg)
         }
    
     })
        }
    } else {
        alert(doneData.errormsg);
    }
}).catch(err)
        } else {
                                elem("text-secondary").innerHTML = `Currently placing: ${getShipName(shipsToPlace)} (Length ${getShipLength(shipsToPlace)})<br>${shipsToPlace} more ships to go!<br><br>`;
        }
    } else {
        alert(placeData.errormsg);
 /*          shipStart.getPoints().forEach((point) => {
                        //consofle.log(point);
          elem(point.asString).innerHTML = " ";  
        })
        shipsToPlace += 1;
        elem("text-secondary").innerHTML = `Currently placing: ${getShipName(shipsToPlace)} (Length ${getShipLength(shipsToPlace)})<br>${shipsToPlace} more ships to go!<br><br>`;*/
    }
}).catch(err)


    }
}
elem("cancel").onclick = function() {
    if(placestate == 1) {
        //right
        var ship = new Ship(currentselect, getShipLength(shipsToPlace), false)
        shipStart = ship;
        isUp = false;
   ship.getPoints().forEach((point) => {
                        //console.log(point);
          elem(point.asString).innerHTML = getShipLetter(shipsToPlace);  
        })
        elem("cancel").disabled = false
        elem("confirm").disabled = false
                elem("confirm").innerHTML = "Confirm";
        elem("cancel").innerHTML = "Cancel";
        placestate = 2;
    } else if(placestate == 2) {
        placestate = 1;
                elem("cancel").style.display = "none"
        elem("confirm").style.display = "none"
        var ship = shipStart;
        ship.getPoints().forEach((point) => {
            elem(point.asString).innerHTML = " ";
        })
    }
}



//actual code
                elem("text-main").innerHTML = "Retrieving game board.."
                sendRequest("../api/get_board.php?id="+gameId+"&playerId="+playerId).then((boardInfo) => {
                    if(boardInfo.success) {    
                        if(boardInfo.state == 0) {
                                  
                            shipsToPlace = boardInfo.shipsToPlace;
                            if(shipsToPlace != 0) {
                        elem("text-main").innerHTML = "Place your ships<br>"
                        elem("text-secondary").innerHTML = `Currently placing: ${getShipName(shipsToPlace)} (Length ${getShipLength(shipsToPlace)})<br>${shipsToPlace} more ships to go!<br><br>`;
                        board = boardInfo.board;
                        boardwidth = board[0].length;
                        boardheight = board.length;
                        console.log(boardwidth, boardheight);
                        createTable(board, false);
                        tableListener()
                            }  else {
                                waitingforopponent = true;
                                $("#placeboard").hide();
                                elem("text-main").innerHTML = "waiting for opponent to place ships..."
                            }
                        } else if(boardInfo.state == 1) {

        placing = false;
        elem("text-main").innerHTML = ""
        elem("text-secondary").innerHTML = ""

        state = 1;
    sendRequest("../api/get_enemy_board.php?id="+gameId+"&playerId="+playerId).then((enemyBoardData) => {
         if(enemyBoardData.success) {
             createTable(enemyBoardData.board, true);
                                     board = boardInfo.board;
                        boardwidth = board[0].length;
                        boardheight = board.length;
                        console.log(boardwidth, boardheight);
                        createTable(board, false);
                        tableListener()
                     enemyListener()
                     $("#placeBoard").show();
                     $("#enemyBoard").appendTo("#row");
                     $("#placeBoard").prependTo("#row");
                     elem("placeBoard").className = "table table-bordered col-md-6"
                     elem("enemyBoard").className = "table table-bordered col-md-6"
                      elem("rfow").style.display = "";

         }
    })
                    

                            
                        }
                    } else {
elem("text-main").innerHTML = "Failed fetching board!<br><br>"+boardInfo.errormsg;
                    }
                }).catch(err)
//}

setInterval(() => {
    if(state == 1 ) {
        
     sendRequest("../api/get_turn.php?id="+gameId+"&playerId="+playerId).then((turnData) => {
         if(turnData.success) {
             turn = turnData.yourTurn;
                elem("text-main").innerHTML = turn ? "Your turn!" : "Opponent's turn.."
         }
     })

                     sendRequest("../api/get_enemy_board.php?id="+gameId+"&playerId="+playerId).then((enemyBoardData) => {
         if(enemyBoardData.success) {
             updateEnemyBoard(enemyBoardData.board)
             serverResponded = true;
         } else {
             alert(enemyBoardData.errormsg)
         }
     })
                          sendRequest("../api/get_board.php?id="+gameId+"&playerId="+playerId).then((boardData) => {
         if(boardData.success) {
             updateBoard(boardData.board)
             serverResponded = true;
         } else {
             alert(boardData.errormsg)
         }
     })

            sendRequest("../api/get_state.php?id="+gameId+"&playerId="+playerId).then((stateData) => {
         if(stateData.success) {
             if(stateData.state == 2) {
                 state = 2;
                 if(stateData.win) {
                     //ez
                     elem("text-main").innerHTML = "You won! Congrats!"
                 } else {
                     //f'
                     elem("text-main").innerHTML = "You lost! Better luck next time-"
                 }
             }
         } else {
             alert(boardData.errormsg)
         }
     })

                        sendRequest("../api/stats.php?id="+gameId+"&playerId="+playerId).then((statsData) => {
         if(statsData.success) {
            elem("text-secondary").innerHTML = `${statsData.shipsSunkPlayer} of your ships have been sunk.<br>You have sunk ${statsData.shipsSunkEnemy} opponent ships!`
            /*
            colorCells(statsData.pointsHitEnemy, false)
            colorCells(statsData.pointsHitPlayer, true) */
         }
     })
    }

    if(waitingforopponent) {
        sendRequest("../api/opponent_finished.php?id="+gameId+"&playerId="+playerId).then((data) => {
            if(data.enemyFinished) {
                 waitingforopponent = false;
                        elem("text-main").innerHTML = ""
        elem("text-secondary").innerHTML = ""

        state = 1;
    sendRequest("../api/get_enemy_board.php?id="+gameId+"&playerId="+playerId).then((enemyBoardData) => {
         if(enemyBoardData.success) {
             createTable(enemyBoardData.board, true);
                     enemyListener()
                     $("#placeBoard").show();
                     $("#enemyBoard").appendTo("#row");
                     $("#placeBoard").prependTo("#row");
                     elem("placeBoard").className = "table table-bordered col-md-6"
                     elem("enemyBoard").className = "table table-bordered col-md-6"
                      elem("rfow").style.display = "";

         }
    })
                
                
            } else {
                elem("text-secondary").innerHTML = `Opponent needs to place ${data.needToPlace} ships.`
                
            }
        })
    }
}, 1000)
