var state = 0;
var board = undefined;

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

    function placeCellClick(pos) {
        alert(pos.asString)
    }
function reconnect() {
    elem("text-main").innerHTML = "Reconnect Feature priority: low"
}
function err(e) {
elem("text-main").innerHTML = "Unexpected Error!<br>Check console for detailed info"
console.log(e)
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
                        elem("text-main").innerHTML = "Place your ships!<br><br>"
                        board = boardInfo.board;
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
