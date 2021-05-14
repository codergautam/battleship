class Ship {
    constructor(pos, length, up) {
                this.length = length;
                this.up = up
                this.starting = up ? new Position(pos.x, pos.y+length) : pos
    }

    getPoints() {
        var points = [];
        if(this.up) {
            if(((this.starting.y)-this.length+1) < 0 ){
                console.log((this.starting.y)-this.length+1)
                console.log("STARTINGY: "+this.starting.y);
                console.log("LENGTH: "+this.length);
                return null;
            }

            for (var i = 0; i < this.length; i++) {
                points[points.length] = new Position(this.starting.x, this.starting.y-i-1)
            }

        } else {
            if(this.starting.x < 0 ){
                return null;
            }

            for (i = 0; i < this.length; i++) {
                points[points.length] = new Position(this.starting.x+i,  this.starting.y);
            }

        }
        return points;
    }
}