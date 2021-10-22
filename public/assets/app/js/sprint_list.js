var sql = require('mssql');

var config = { 
    user: 'dwokr', 
    password: 'dwokr@)@!21', 
    server: '211.233.21.82', 
    database: 'DWOKR', 
    options: { encrypt: true }
} 

sql.connect(config, err => {
    // ... error checks
    console.log(err.message);

    // Stored Procedure
    new sql.Request()
    .input('input_parameter', Int, value)
    .output('output_parameter', VarChar(50))
    .execute('USP_SEARCH_SPRINTMEETING_LIST', (err, result) => {
        // ... error checks
        console.log(err.message);

        console.dir(result)
    })
})