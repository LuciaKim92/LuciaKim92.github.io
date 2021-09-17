'use strict';

    function Square(props) {
        return (
          <button className="square" onClick={props.onClick} style={props.style}>
            {props.value}
          </button>
        );
    }
  
  class Board extends React.Component {


    renderSquare(i) {

    const isWinningIndex = this.props.winningIndex && this.props.winningIndex.indexOf(i) !== -1
    let btnstyle = {"backgroundColor": (isWinningIndex ? "deepskyblue" : "")};

      return <Square 
                key={`button-${i}`}
                value={this.props.squares[i]} 
                onClick={() => this.props.onClick(i)}
                style={btnstyle}
            />;
    }
  
    render() {
      const boardRows = [];
      for(let i = 0, len = Math.sqrt(this.props.squares.length); i < len; i++) {
        const innerCols = [];
        for(let j = 0; j < len; j++) {
          innerCols.push(this.renderSquare((i * len) + j));
        }
        boardRows.push(
         <div className="board-row" key={`row-${i}`}>
            {innerCols}
         </div> 
        );
      }
      
      return (
        <div>
          {boardRows}
        </div>
      );
    }
  }
  
  class Game extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
          history: [{
            squares: Array(9).fill(null),
            currentSquareIndex: null,
          }],
          xIsNext: true,
          stepNumber: 0,
        };
    }

    handleClick(i) {
        const history = this.state.history.slice(0, this.state.stepNumber + 1);
        const current = history[history.length - 1];
        const squares = current.squares.slice();

        if (calculateWinner(squares) || squares[i]) {
            return;
        }
        squares[i] = this.state.xIsNext ? 'X' : 'O';
        this.setState({
            history: history.concat([{
              squares: squares,
              currentSquareIndex: i,
            }]),
            stepNumber: history.length,
            xIsNext: !this.state.xIsNext,
          });
    }

    jumpTo(step) {
        this.setState({
          stepNumber: step,
          xIsNext: (step % 2) === 0,
        });
      }

    render() {

    const history = this.state.history;
    const current = history[this.state.stepNumber];
    const winner = calculateWinner(current.squares);

    const moves = history.map((step, move) => {
        const { x, y } = getCoordBySquareIndex(step.currentSquareIndex);
        const desc = move ?
          `Go to move #${move} - (${x}, ${y})`:
          'Go to game start';
        
        let btnstyle = {"fontWeight": (this.state.stepNumber === move ? "bold" : "normal")};

        return (
          <li key={move}>
            <button style={btnstyle} onClick={() => this.jumpTo(move)}>{desc}</button>
          </li>
        );
      });


    let status;
    let winningIndex = null;

    if (winner) {
      status = `Winner: ${winner.player}`;
      winningIndex = winner.winningIndex;
    } else {
      status = 'Next player: ' + (this.state.xIsNext ? 'X' : 'O');
    }

      return (
        <div className="game">
          <div className="game-board">
            <Board 
                squares={current.squares}
                onClick={(i) => this.handleClick(i)}
                winningIndex={winningIndex}
            />
          </div>
          <div className="game-info">
            <div>{status}</div>
            <ol>{moves}</ol>
          </div>
        </div>
      );
    }
  }

  function calculateWinner(squares) {
    const lines = [
      [0, 1, 2],
      [3, 4, 5],
      [6, 7, 8],
      [0, 3, 6],
      [1, 4, 7],
      [2, 5, 8],
      [0, 4, 8],
      [2, 4, 6],
    ];

    for (let i = 0; i < lines.length; i++) {
      const [a, b, c] = lines[i];
      if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {

        return{
          player: squares[a],
          winningIndex: [a,b,c]
        };
      }
    }
    return null;
  }

  function getCoordBySquareIndex(i) {
    return {
      x: Math.floor(i / 3),
      y: i % 3, 
    }
  }
  
  // ========================================
  
  ReactDOM.render(
     <Game />, document.getElementById('mytest')
  );
  
