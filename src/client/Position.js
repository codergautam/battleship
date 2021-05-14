class Position {
    constructor(x, y)
    {
        //console.log(x,y)
        if(y || y == 0) {
        this.x = x;
        this.y = y;
        var alphas = Array.from(Array(26)).map((e, i) => i + 65).map((x) => String.fromCharCode(x));
        this.asString = alphas[y]+(x+1);
        } else {
        this.asString = x;
        this.x = parseInt(x.charAt(1))-1;
        this.y = x.charCodeAt(0) - 97;
        }
    }
}