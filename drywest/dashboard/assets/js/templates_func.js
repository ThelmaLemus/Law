$("head").append('<script type="text/javascript" src="../assets/js/moments.js"></script>');

var MESES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
    'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
function dateParser(date){
    date = new Date(date);
    // date.setDate(date.getDate() + 1);


    const DIAS = ['uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince',
        'dieciséis', 'diecisiete', 'dieciocho','diecinueve','veinte','veintiuno','veintidós','vientitrés','veinticuatro','veinticinco','veintiséis','veintisiete',
        'veintiocho','veintinueve','treinta'];
    DIAS.push(DIAS[29] + " y " + DIAS[0], DIAS[29] + " y " + DIAS[1], DIAS[29] + " y " + DIAS[2], DIAS[29] + " y " + DIAS[3], DIAS[29] + " y " + DIAS[4], DIAS[29] + " y " + DIAS[5],    
        DIAS[29] + " y " + DIAS[6], DIAS[29] + " y " + DIAS[7], DIAS[29] + " y " + DIAS[8],'cuarenta');    
    DIAS.push(DIAS[39] + " y " + DIAS[0], DIAS[39] + " y " + DIAS[1], DIAS[39] + " y " + DIAS[2], DIAS[39] + " y " + DIAS[3], DIAS[39] + " y " + DIAS[4], DIAS[39] + " y " + DIAS[5],    
        DIAS[39] + " y " + DIAS[6], DIAS[39] + " y " + DIAS[7], DIAS[39] + " y " + DIAS[8],'cincuenta');    
    DIAS.push(DIAS[49] + " y " + DIAS[0], DIAS[49] + " y " + DIAS[1], DIAS[49] + " y " + DIAS[2], DIAS[49] + " y " + DIAS[3], DIAS[49] + " y " + DIAS[4], DIAS[49] + " y " + DIAS[5],    
        DIAS[49] + " y " + DIAS[6], DIAS[49] + " y " + DIAS[7], DIAS[49] + " y " + DIAS[8],'sesenta');    
    DIAS.push(DIAS[59] + " y " + DIAS[0], DIAS[59] + " y " + DIAS[1], DIAS[59] + " y " + DIAS[2], DIAS[59] + " y " + DIAS[3], DIAS[59] + " y " + DIAS[4], DIAS[59] + " y " + DIAS[5],    
        DIAS[59] + " y " + DIAS[6], DIAS[59] + " y " + DIAS[7], DIAS[59] + " y " + DIAS[8],'setenta');    
    DIAS.push(DIAS[69] + " y " + DIAS[0], DIAS[69] + " y " + DIAS[1], DIAS[69] + " y " + DIAS[2], DIAS[69] + " y " + DIAS[3], DIAS[69] + " y " + DIAS[4], DIAS[69] + " y " + DIAS[5],    
        DIAS[69] + " y " + DIAS[6], DIAS[69] + " y " + DIAS[7], DIAS[69] + " y " + DIAS[8],'ochenta');    
    DIAS.push(DIAS[79] + " y " + DIAS[0], DIAS[79] + " y " + DIAS[1], DIAS[79] + " y " + DIAS[2], DIAS[79] + " y " + DIAS[3], DIAS[79] + " y " + DIAS[4], DIAS[79] + " y " + DIAS[5],    
        DIAS[79] + " y " + DIAS[6], DIAS[79] + " y " + DIAS[7], DIAS[79] + " y " + DIAS[8],'noventa');    
    DIAS.push(DIAS[89] + " y " + DIAS[0], DIAS[89] + " y " + DIAS[1], DIAS[89] + " y " + DIAS[2], DIAS[89] + " y " + DIAS[3], DIAS[89] + " y " + DIAS[4], DIAS[89] + " y " + DIAS[5],    
        DIAS[89] + " y " + DIAS[6], DIAS[89] + " y " + DIAS[7], DIAS[89] + " y " + DIAS[8],'cien');

    DIAS.push("ciento "+DIAS[0], "ciento "+DIAS[1], "ciento "+DIAS[2], "ciento "+DIAS[3], "ciento "+DIAS[4], "ciento "+DIAS[5],    
        "ciento " + DIAS[6], "ciento " + DIAS[7], "ciento " + DIAS[8], "ciento " + DIAS[9], "ciento " + DIAS[10], "ciento " + DIAS[11], "ciento " + DIAS[12], "ciento " + DIAS[13],
        "ciento " + DIAS[14], "ciento " + DIAS[15], "ciento " + DIAS[16], "ciento " + DIAS[17], "ciento " + DIAS[18], "ciento " + DIAS[19], "ciento " + DIAS[20], "ciento " + DIAS[21],
        "ciento " + DIAS[22], "ciento " + DIAS[23], "ciento " + DIAS[24], "ciento " + DIAS[25], "ciento " + DIAS[26], "ciento " + DIAS[27], "ciento " + DIAS[28], "ciento " + DIAS[29],);    
    DIAS.push("ciento "+DIAS[29] + " y " + DIAS[0], "ciento "+DIAS[29] + " y " + DIAS[1], "ciento "+DIAS[29] + " y " + DIAS[2], "ciento "+DIAS[29] + " y " + DIAS[3], "ciento "+DIAS[29] + " y " + DIAS[4], "ciento "+DIAS[29] + " y " + DIAS[5],    
        "ciento "+DIAS[29] + " y " + DIAS[6], "ciento "+DIAS[29] + " y " + DIAS[7], "ciento "+DIAS[29] + " y " + DIAS[8], "ciento "+DIAS[39]);    
    DIAS.push("ciento "+DIAS[39] + " y " + DIAS[0], "ciento "+DIAS[39] + " y " + DIAS[1], "ciento "+DIAS[39] + " y " + DIAS[2], "ciento "+DIAS[39] + " y " + DIAS[3], "ciento "+DIAS[39] + " y " + DIAS[4], "ciento "+DIAS[39] + " y " + DIAS[5],    
        "ciento "+DIAS[39] + " y " + DIAS[6], "ciento "+DIAS[39] + " y " + DIAS[7], "ciento "+DIAS[39] + " y " + DIAS[8], "ciento "+DIAS[49]);    
    DIAS.push("ciento "+DIAS[49] + " y " + DIAS[0], "ciento "+DIAS[49] + " y " + DIAS[1], "ciento "+DIAS[49] + " y " + DIAS[2], "ciento "+DIAS[49] + " y " + DIAS[3], "ciento "+DIAS[49] + " y " + DIAS[4], "ciento "+DIAS[49] + " y " + DIAS[5],    
        "ciento "+DIAS[49] + " y " + DIAS[6], "ciento "+DIAS[49] + " y " + DIAS[7], "ciento "+DIAS[49] + " y " + DIAS[8], "ciento "+DIAS[59]);    
    DIAS.push("ciento "+DIAS[59] + " y " + DIAS[0], "ciento "+DIAS[59] + " y " + DIAS[1], "ciento "+DIAS[59] + " y " + DIAS[2], "ciento "+DIAS[59] + " y " + DIAS[3], "ciento "+DIAS[59] + " y " + DIAS[4], "ciento "+DIAS[59] + " y " + DIAS[5],    
        "ciento "+DIAS[59] + " y " + DIAS[6], "ciento "+DIAS[59] + " y " + DIAS[7], "ciento "+DIAS[59] + " y " + DIAS[8], "ciento "+DIAS[69]);    
    DIAS.push("ciento "+DIAS[69] + " y " + DIAS[0], "ciento "+DIAS[69] + " y " + DIAS[1], "ciento "+DIAS[69] + " y " + DIAS[2], "ciento "+DIAS[69] + " y " + DIAS[3], "ciento "+DIAS[69] + " y " + DIAS[4], "ciento "+DIAS[69] + " y " + DIAS[5],    
        "ciento "+DIAS[69] + " y " + DIAS[6], "ciento "+DIAS[69] + " y " + DIAS[7], "ciento "+DIAS[69] + " y " + DIAS[8], "ciento "+DIAS[79]);    
    DIAS.push("ciento "+DIAS[79] + " y " + DIAS[0], "ciento "+DIAS[79] + " y " + DIAS[1], "ciento "+DIAS[79] + " y " + DIAS[2], "ciento "+DIAS[79] + " y " + DIAS[3], "ciento "+DIAS[79] + " y " + DIAS[4], "ciento "+DIAS[79] + " y " + DIAS[5],    
        "ciento "+DIAS[79] + " y " + DIAS[6], "ciento "+DIAS[79] + " y " + DIAS[7], "ciento "+DIAS[79] + " y " + DIAS[8], "ciento "+DIAS[89]);    
    DIAS.push("ciento "+DIAS[89] + " y " + DIAS[0], "ciento "+DIAS[89] + " y " + DIAS[1], "ciento "+DIAS[89] + " y " + DIAS[2], "ciento "+DIAS[89] + " y " + DIAS[3], "ciento "+DIAS[89] + " y " + DIAS[4], "ciento "+DIAS[89] + " y " + DIAS[5],    
        "ciento "+DIAS[89] + " y " + DIAS[6], "ciento "+DIAS[89] + " y " + DIAS[7], "ciento "+DIAS[89] + " y " + DIAS[8],'docientos');    

    DIAS.push("docientos " + DIAS[0], "docientos " + DIAS[1], "docientos " + DIAS[2], "docientos " + DIAS[3], "docientos " + DIAS[4], "docientos " + DIAS[5],
        "docientos " + DIAS[6], "docientos " + DIAS[7], "docientos " + DIAS[8], "docientos " + DIAS[9], "docientos " + DIAS[10], "docientos " + DIAS[11], "docientos " + DIAS[12], "docientos " + DIAS[13],
        "docientos " + DIAS[14], "docientos " + DIAS[15], "docientos " + DIAS[16], "docientos " + DIAS[17], "docientos " + DIAS[18], "docientos " + DIAS[19], "docientos " + DIAS[20], "docientos " + DIAS[21],
        "docientos " + DIAS[22], "docientos " + DIAS[23], "docientos " + DIAS[24], "docientos " + DIAS[25], "docientos " + DIAS[26], "docientos " + DIAS[27], "docientos " + DIAS[28], "docientos " + DIAS[29]);
    DIAS.push("docientos " + DIAS[29] + " y " + DIAS[0], "docientos " + DIAS[29] + " y " + DIAS[1], "docientos " + DIAS[29] + " y " + DIAS[2], "docientos " + DIAS[29] + " y " + DIAS[3], "docientos " + DIAS[29] + " y " + DIAS[4], "docientos " + DIAS[29] + " y " + DIAS[5],
        "docientos " + DIAS[29] + " y " + DIAS[6], "docientos " + DIAS[29] + " y " + DIAS[7], "docientos " + DIAS[29] + " y " + "docientos "+DIAS[39]);
    DIAS.push("docientos " + DIAS[39] + " y " + DIAS[0], "docientos " + DIAS[39] + " y " + DIAS[1], "docientos " + DIAS[39] + " y " + DIAS[2], "docientos " + DIAS[39] + " y " + DIAS[3], "docientos " + DIAS[39] + " y " + DIAS[4], "docientos " + DIAS[39] + " y " + DIAS[5],
        "docientos " + DIAS[39] + " y " + DIAS[6], "docientos " + DIAS[39] + " y " + DIAS[7], "docientos " + DIAS[39] + " y " + "docientos "+DIAS[49]);
    DIAS.push("docientos " + DIAS[49] + " y " + DIAS[0], "docientos " + DIAS[49] + " y " + DIAS[1], "docientos " + DIAS[49] + " y " + DIAS[2], "docientos " + DIAS[49] + " y " + DIAS[3], "docientos " + DIAS[49] + " y " + DIAS[4], "docientos " + DIAS[49] + " y " + DIAS[5],
        "docientos " + DIAS[49] + " y " + DIAS[6], "docientos " + DIAS[49] + " y " + DIAS[7], "docientos " + DIAS[49] + " y " + "docientos "+DIAS[59]);
    DIAS.push("docientos " + DIAS[59] + " y " + DIAS[0], "docientos " + DIAS[59] + " y " + DIAS[1], "docientos " + DIAS[59] + " y " + DIAS[2], "docientos " + DIAS[59] + " y " + DIAS[3], "docientos " + DIAS[59] + " y " + DIAS[4], "docientos " + DIAS[59] + " y " + DIAS[5],
        "docientos " + DIAS[59] + " y " + DIAS[6], "docientos " + DIAS[59] + " y " + DIAS[7], "docientos " + DIAS[59] + " y " + "docientos "+DIAS[69]);
    DIAS.push("docientos " + DIAS[69] + " y " + DIAS[0], "docientos " + DIAS[69] + " y " + DIAS[1], "docientos " + DIAS[69] + " y " + DIAS[2], "docientos " + DIAS[69] + " y " + DIAS[3], "docientos " + DIAS[69] + " y " + DIAS[4], "docientos " + DIAS[69] + " y " + DIAS[5],
        "docientos " + DIAS[69] + " y " + DIAS[6], "docientos " + DIAS[69] + " y " + DIAS[7], "docientos " + DIAS[69] + " y " + "docientos "+DIAS[79]);
    DIAS.push("docientos " + DIAS[79] + " y " + DIAS[0], "docientos " + DIAS[79] + " y " + DIAS[1], "docientos " + DIAS[79] + " y " + DIAS[2], "docientos " + DIAS[79] + " y " + DIAS[3], "docientos " + DIAS[79] + " y " + DIAS[4], "docientos " + DIAS[79] + " y " + DIAS[5],
        "docientos " + DIAS[79] + " y " + DIAS[6], "docientos " + DIAS[79] + " y " + DIAS[7], "docientos " + DIAS[79] + " y " + "docientos "+DIAS[89]);
    DIAS.push("docientos " + DIAS[89] + " y " + DIAS[0], "docientos " + DIAS[89] + " y " + DIAS[1], "docientos " + DIAS[89] + " y " + DIAS[2], "docientos " + DIAS[89] + " y " + DIAS[3], "docientos " + DIAS[89] + " y " + DIAS[4], "docientos " + DIAS[89] + " y " + DIAS[5],
        "docientos " + DIAS[89] + " y " + DIAS[6], "docientos " + DIAS[89] + " y " + DIAS[7], "docientos " + DIAS[89] + " y " + DIAS[8], 'trecientos'); 
    
    DIAS.push("trecientos " + DIAS[0], "trecientos " + DIAS[1], "trecientos " + DIAS[2], "trecientos " + DIAS[3], "trecientos " + DIAS[4], "trecientos " + DIAS[5],
        "trecientos " + DIAS[6], "trecientos " + DIAS[7], "trecientos " + DIAS[8], "trecientos " + DIAS[9], "trecientos " + DIAS[10], "trecientos " + DIAS[11], "trecientos " + DIAS[12], "trecientos " + DIAS[13],
        "trecientos " + DIAS[14], "trecientos " + DIAS[15], "trecientos " + DIAS[16], "trecientos " + DIAS[17], "trecientos " + DIAS[18], "trecientos " + DIAS[19], "trecientos " + DIAS[20], "trecientos " + DIAS[21],
        "trecientos " + DIAS[22], "trecientos " + DIAS[23], "trecientos " + DIAS[24], "trecientos " + DIAS[25], "trecientos " + DIAS[26], "trecientos " + DIAS[27], "trecientos " + DIAS[28], "trecientos " + DIAS[29]);
    DIAS.push("trecientos " + DIAS[29] + " y " + DIAS[0], "trecientos " + DIAS[29] + " y " + DIAS[1], "trecientos " + DIAS[29] + " y " + DIAS[2], "trecientos " + DIAS[29] + " y " + DIAS[3], "trecientos " + DIAS[29] + " y " + DIAS[4], "trecientos " + DIAS[29] + " y " + DIAS[5],
        "trecientos " + DIAS[29] + " y " + DIAS[6], "trecientos " + DIAS[29] + " y " + DIAS[7], "trecientos " + DIAS[29] + " y " + "trecientos "+DIAS[39]);
    DIAS.push("trecientos " + DIAS[39] + " y " + DIAS[0], "trecientos " + DIAS[39] + " y " + DIAS[1], "trecientos " + DIAS[39] + " y " + DIAS[2], "trecientos " + DIAS[39] + " y " + DIAS[3], "trecientos " + DIAS[39] + " y " + DIAS[4], "trecientos " + DIAS[39] + " y " + DIAS[5],
        "trecientos " + DIAS[39] + " y " + DIAS[6], "trecientos " + DIAS[39] + " y " + DIAS[7], "trecientos " + DIAS[39] + " y " + "trecientos "+DIAS[49]);
    DIAS.push("trecientos " + DIAS[49] + " y " + DIAS[0], "trecientos " + DIAS[49] + " y " + DIAS[1], "trecientos " + DIAS[49] + " y " + DIAS[2], "trecientos " + DIAS[49] + " y " + DIAS[3], "trecientos " + DIAS[49] + " y " + DIAS[4], "trecientos " + DIAS[49] + " y " + DIAS[5],
        "trecientos " + DIAS[49] + " y " + DIAS[6], "trecientos " + DIAS[49] + " y " + DIAS[7], "trecientos " + DIAS[49] + " y " + "trecientos "+DIAS[59]);
    DIAS.push("trecientos " + DIAS[59] + " y " + DIAS[0], "trecientos " + DIAS[59] + " y " + DIAS[1], "trecientos " + DIAS[59] + " y " + DIAS[2], "trecientos " + DIAS[59] + " y " + DIAS[3], "trecientos " + DIAS[59] + " y " + DIAS[4], "trecientos " + DIAS[59] + " y " + DIAS[5],
        "trecientos " + DIAS[59] + " y " + DIAS[6], "trecientos " + DIAS[59] + " y " + DIAS[7], "trecientos " + DIAS[59] + " y " + "trecientos "+DIAS[69]);
    DIAS.push("trecientos " + DIAS[69] + " y " + DIAS[0], "trecientos " + DIAS[69] + " y " + DIAS[1], "trecientos " + DIAS[69] + " y " + DIAS[2], "trecientos " + DIAS[69] + " y " + DIAS[3], "trecientos " + DIAS[69] + " y " + DIAS[4], "trecientos " + DIAS[69] + " y " + DIAS[5],
        "trecientos " + DIAS[69] + " y " + DIAS[6], "trecientos " + DIAS[69] + " y " + DIAS[7], "trecientos " + DIAS[69] + " y " + "trecientos "+DIAS[79]);
    DIAS.push("trecientos " + DIAS[79] + " y " + DIAS[0], "trecientos " + DIAS[79] + " y " + DIAS[1], "trecientos " + DIAS[79] + " y " + DIAS[2], "trecientos " + DIAS[79] + " y " + DIAS[3], "trecientos " + DIAS[79] + " y " + DIAS[4], "trecientos " + DIAS[79] + " y " + DIAS[5],
        "trecientos " + DIAS[79] + " y " + DIAS[6], "trecientos " + DIAS[79] + " y " + DIAS[7], "trecientos " + DIAS[79] + " y " + "trecientos "+DIAS[89]);
    DIAS.push("trecientos " + DIAS[89] + " y " + DIAS[0], "trecientos " + DIAS[89] + " y " + DIAS[1], "trecientos " + DIAS[89] + " y " + DIAS[2], "trecientos " + DIAS[89] + " y " + DIAS[3], "trecientos " + DIAS[89] + " y " + DIAS[4], "trecientos " + DIAS[89] + " y " + DIAS[5],
        "trecientos " + DIAS[89] + " y " + DIAS[6], "trecientos " + DIAS[89] + " y " + DIAS[7], "trecientos " + DIAS[89] + " y " + DIAS[8], 'cuatrocientos'); 
    
    DIAS.push("cuatrocientos " + DIAS[0], "cuatrocientos " + DIAS[1], "cuatrocientos " + DIAS[2], "cuatrocientos " + DIAS[3], "cuatrocientos " + DIAS[4], "cuatrocientos " + DIAS[5],
        "cuatrocientos " + DIAS[6], "cuatrocientos " + DIAS[7], "cuatrocientos " + DIAS[8], "cuatrocientos " + DIAS[9], "cuatrocientos " + DIAS[10], "cuatrocientos " + DIAS[11], "cuatrocientos " + DIAS[12], "cuatrocientos " + DIAS[13],
        "cuatrocientos " + DIAS[14], "cuatrocientos " + DIAS[15], "cuatrocientos " + DIAS[16], "cuatrocientos " + DIAS[17], "cuatrocientos " + DIAS[18], "cuatrocientos " + DIAS[19], "cuatrocientos " + DIAS[20], "cuatrocientos " + DIAS[21],
        "cuatrocientos " + DIAS[22], "cuatrocientos " + DIAS[23], "cuatrocientos " + DIAS[24], "cuatrocientos " + DIAS[25], "cuatrocientos " + DIAS[26], "cuatrocientos " + DIAS[27], "cuatrocientos " + DIAS[28], "cuatrocientos " + DIAS[29]);
    DIAS.push("cuatrocientos " + DIAS[29] + " y " + DIAS[0], "cuatrocientos " + DIAS[29] + " y " + DIAS[1], "cuatrocientos " + DIAS[29] + " y " + DIAS[2], "cuatrocientos " + DIAS[29] + " y " + DIAS[3], "cuatrocientos " + DIAS[29] + " y " + DIAS[4], "cuatrocientos " + DIAS[29] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[29] + " y " + DIAS[6], "cuatrocientos " + DIAS[29] + " y " + DIAS[7], "cuatrocientos " + DIAS[29] + " y " + DIAS[8], 'cuarenta');
    DIAS.push("cuatrocientos " + DIAS[39] + " y " + DIAS[0], "cuatrocientos " + DIAS[39] + " y " + DIAS[1], "cuatrocientos " + DIAS[39] + " y " + DIAS[2], "cuatrocientos " + DIAS[39] + " y " + DIAS[3], "cuatrocientos " + DIAS[39] + " y " + DIAS[4], "cuatrocientos " + DIAS[39] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[39] + " y " + DIAS[6], "cuatrocientos " + DIAS[39] + " y " + DIAS[7], "cuatrocientos " + DIAS[39] + " y " + DIAS[8], 'cincuenta');
    DIAS.push("cuatrocientos " + DIAS[49] + " y " + DIAS[0], "cuatrocientos " + DIAS[49] + " y " + DIAS[1], "cuatrocientos " + DIAS[49] + " y " + DIAS[2], "cuatrocientos " + DIAS[49] + " y " + DIAS[3], "cuatrocientos " + DIAS[49] + " y " + DIAS[4], "cuatrocientos " + DIAS[49] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[49] + " y " + DIAS[6], "cuatrocientos " + DIAS[49] + " y " + DIAS[7], "cuatrocientos " + DIAS[49] + " y " + DIAS[8], 'sesenta');
    DIAS.push("cuatrocientos " + DIAS[59] + " y " + DIAS[0], "cuatrocientos " + DIAS[59] + " y " + DIAS[1], "cuatrocientos " + DIAS[59] + " y " + DIAS[2], "cuatrocientos " + DIAS[59] + " y " + DIAS[3], "cuatrocientos " + DIAS[59] + " y " + DIAS[4], "cuatrocientos " + DIAS[59] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[59] + " y " + DIAS[6], "cuatrocientos " + DIAS[59] + " y " + DIAS[7], "cuatrocientos " + DIAS[59] + " y " + DIAS[8], 'setenta');
    DIAS.push("cuatrocientos " + DIAS[69] + " y " + DIAS[0], "cuatrocientos " + DIAS[69] + " y " + DIAS[1], "cuatrocientos " + DIAS[69] + " y " + DIAS[2], "cuatrocientos " + DIAS[69] + " y " + DIAS[3], "cuatrocientos " + DIAS[69] + " y " + DIAS[4], "cuatrocientos " + DIAS[69] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[69] + " y " + DIAS[6], "cuatrocientos " + DIAS[69] + " y " + DIAS[7], "cuatrocientos " + DIAS[69] + " y " + DIAS[8], 'ochenta');
    DIAS.push("cuatrocientos " + DIAS[79] + " y " + DIAS[0], "cuatrocientos " + DIAS[79] + " y " + DIAS[1], "cuatrocientos " + DIAS[79] + " y " + DIAS[2], "cuatrocientos " + DIAS[79] + " y " + DIAS[3], "cuatrocientos " + DIAS[79] + " y " + DIAS[4], "cuatrocientos " + DIAS[79] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[79] + " y " + DIAS[6], "cuatrocientos " + DIAS[79] + " y " + DIAS[7], "cuatrocientos " + DIAS[79] + " y " + DIAS[8], 'noventa');
    DIAS.push("cuatrocientos " + DIAS[89] + " y " + DIAS[0], "cuatrocientos " + DIAS[89] + " y " + DIAS[1], "cuatrocientos " + DIAS[89] + " y " + DIAS[2], "cuatrocientos " + DIAS[89] + " y " + DIAS[3], "cuatrocientos " + DIAS[89] + " y " + DIAS[4], "cuatrocientos " + DIAS[89] + " y " + DIAS[5],
        "cuatrocientos " + DIAS[89] + " y " + DIAS[6], "cuatrocientos " + DIAS[89] + " y " + DIAS[7], "cuatrocientos " + DIAS[89] + " y " + DIAS[8], 'quinientos'); 
    
    DIAS.push("quinientos " + DIAS[0], "quinientos " + DIAS[1], "quinientos " + DIAS[2], "quinientos " + DIAS[3], "quinientos " + DIAS[4], "quinientos " + DIAS[5],
        "quinientos " + DIAS[6], "quinientos " + DIAS[7], "quinientos " + DIAS[8], "quinientos " + DIAS[9], "quinientos " + DIAS[10], "quinientos " + DIAS[11], "quinientos " + DIAS[12], "quinientos " + DIAS[13],
        "quinientos " + DIAS[14], "quinientos " + DIAS[15], "quinientos " + DIAS[16], "quinientos " + DIAS[17], "quinientos " + DIAS[18], "quinientos " + DIAS[19], "quinientos " + DIAS[20], "quinientos " + DIAS[21],
        "quinientos " + DIAS[22], "quinientos " + DIAS[23], "quinientos " + DIAS[24], "quinientos " + DIAS[25], "quinientos " + DIAS[26], "quinientos " + DIAS[27], "quinientos " + DIAS[28], "quinientos " + DIAS[29]);
    DIAS.push("quinientos " + DIAS[29] + " y " + DIAS[0], "quinientos " + DIAS[29] + " y " + DIAS[1], "quinientos " + DIAS[29] + " y " + DIAS[2], "quinientos " + DIAS[29] + " y " + DIAS[3], "quinientos " + DIAS[29] + " y " + DIAS[4], "quinientos " + DIAS[29] + " y " + DIAS[5],
        "quinientos " + DIAS[29] + " y " + DIAS[6], "quinientos " + DIAS[29] + " y " + DIAS[7], "quinientos " + DIAS[29] + " y " + DIAS[8], 'cuarenta');
    DIAS.push("quinientos " + DIAS[39] + " y " + DIAS[0], "quinientos " + DIAS[39] + " y " + DIAS[1], "quinientos " + DIAS[39] + " y " + DIAS[2], "quinientos " + DIAS[39] + " y " + DIAS[3], "quinientos " + DIAS[39] + " y " + DIAS[4], "quinientos " + DIAS[39] + " y " + DIAS[5],
        "quinientos " + DIAS[39] + " y " + DIAS[6], "quinientos " + DIAS[39] + " y " + DIAS[7], "quinientos " + DIAS[39] + " y " + DIAS[8], 'cincuenta');
    DIAS.push("quinientos " + DIAS[49] + " y " + DIAS[0], "quinientos " + DIAS[49] + " y " + DIAS[1], "quinientos " + DIAS[49] + " y " + DIAS[2], "quinientos " + DIAS[49] + " y " + DIAS[3], "quinientos " + DIAS[49] + " y " + DIAS[4], "quinientos " + DIAS[49] + " y " + DIAS[5],
        "quinientos " + DIAS[49] + " y " + DIAS[6], "quinientos " + DIAS[49] + " y " + DIAS[7], "quinientos " + DIAS[49] + " y " + DIAS[8], 'sesenta');
    DIAS.push("quinientos " + DIAS[59] + " y " + DIAS[0], "quinientos " + DIAS[59] + " y " + DIAS[1], "quinientos " + DIAS[59] + " y " + DIAS[2], "quinientos " + DIAS[59] + " y " + DIAS[3], "quinientos " + DIAS[59] + " y " + DIAS[4], "quinientos " + DIAS[59] + " y " + DIAS[5],
        "quinientos " + DIAS[59] + " y " + DIAS[6], "quinientos " + DIAS[59] + " y " + DIAS[7], "quinientos " + DIAS[59] + " y " + DIAS[8], 'setenta');
    DIAS.push("quinientos " + DIAS[69] + " y " + DIAS[0], "quinientos " + DIAS[69] + " y " + DIAS[1], "quinientos " + DIAS[69] + " y " + DIAS[2], "quinientos " + DIAS[69] + " y " + DIAS[3], "quinientos " + DIAS[69] + " y " + DIAS[4], "quinientos " + DIAS[69] + " y " + DIAS[5],
        "quinientos " + DIAS[69] + " y " + DIAS[6], "quinientos " + DIAS[69] + " y " + DIAS[7], "quinientos " + DIAS[69] + " y " + DIAS[8], 'ochenta');
    DIAS.push("quinientos " + DIAS[79] + " y " + DIAS[0], "quinientos " + DIAS[79] + " y " + DIAS[1], "quinientos " + DIAS[79] + " y " + DIAS[2], "quinientos " + DIAS[79] + " y " + DIAS[3], "quinientos " + DIAS[79] + " y " + DIAS[4], "quinientos " + DIAS[79] + " y " + DIAS[5],
        "quinientos " + DIAS[79] + " y " + DIAS[6], "quinientos " + DIAS[79] + " y " + DIAS[7], "quinientos " + DIAS[79] + " y " + DIAS[8], 'noventa');
    DIAS.push("quinientos " + DIAS[89] + " y " + DIAS[0], "quinientos " + DIAS[89] + " y " + DIAS[1], "quinientos " + DIAS[89] + " y " + DIAS[2], "quinientos " + DIAS[89] + " y " + DIAS[3], "quinientos " + DIAS[89] + " y " + DIAS[4], "quinientos " + DIAS[89] + " y " + DIAS[5],
        "quinientos " + DIAS[89] + " y " + DIAS[6], "quinientos " + DIAS[89] + " y " + DIAS[7], "quinientos " + DIAS[89] + " y " + DIAS[8], 'seiscientos'); 
    
    DIAS.push("seiscientos " + DIAS[0], "seiscientos " + DIAS[1], "seiscientos " + DIAS[2], "seiscientos " + DIAS[3], "seiscientos " + DIAS[4], "seiscientos " + DIAS[5],
        "seiscientos " + DIAS[6], "seiscientos " + DIAS[7], "seiscientos " + DIAS[8], "seiscientos " + DIAS[9], "seiscientos " + DIAS[10], "seiscientos " + DIAS[11], "seiscientos " + DIAS[12], "seiscientos " + DIAS[13],
        "seiscientos " + DIAS[14], "seiscientos " + DIAS[15], "seiscientos " + DIAS[16], "seiscientos " + DIAS[17], "seiscientos " + DIAS[18], "seiscientos " + DIAS[19], "seiscientos " + DIAS[20], "seiscientos " + DIAS[21],
        "seiscientos " + DIAS[22], "seiscientos " + DIAS[23], "seiscientos " + DIAS[24], "seiscientos " + DIAS[25], "seiscientos " + DIAS[26], "seiscientos " + DIAS[27], "seiscientos " + DIAS[28], "seiscientos " + DIAS[29]);
    DIAS.push("seiscientos " + DIAS[29] + " y " + DIAS[0], "seiscientos " + DIAS[29] + " y " + DIAS[1], "seiscientos " + DIAS[29] + " y " + DIAS[2], "seiscientos " + DIAS[29] + " y " + DIAS[3], "seiscientos " + DIAS[29] + " y " + DIAS[4], "seiscientos " + DIAS[29] + " y " + DIAS[5],
        "seiscientos " + DIAS[29] + " y " + DIAS[6], "seiscientos " + DIAS[29] + " y " + DIAS[7], "seiscientos " + DIAS[29] + " y " + DIAS[8], 'cuarenta');
    DIAS.push("seiscientos " + DIAS[39] + " y " + DIAS[0], "seiscientos " + DIAS[39] + " y " + DIAS[1], "seiscientos " + DIAS[39] + " y " + DIAS[2], "seiscientos " + DIAS[39] + " y " + DIAS[3], "seiscientos " + DIAS[39] + " y " + DIAS[4], "seiscientos " + DIAS[39] + " y " + DIAS[5],
        "seiscientos " + DIAS[39] + " y " + DIAS[6], "seiscientos " + DIAS[39] + " y " + DIAS[7], "seiscientos " + DIAS[39] + " y " + DIAS[8], 'cincuenta');
    DIAS.push("seiscientos " + DIAS[49] + " y " + DIAS[0], "seiscientos " + DIAS[49] + " y " + DIAS[1], "seiscientos " + DIAS[49] + " y " + DIAS[2], "seiscientos " + DIAS[49] + " y " + DIAS[3], "seiscientos " + DIAS[49] + " y " + DIAS[4], "seiscientos " + DIAS[49] + " y " + DIAS[5],
        "seiscientos " + DIAS[49] + " y " + DIAS[6], "seiscientos " + DIAS[49] + " y " + DIAS[7], "seiscientos " + DIAS[49] + " y " + DIAS[8], 'sesenta');
    DIAS.push("seiscientos " + DIAS[59] + " y " + DIAS[0], "seiscientos " + DIAS[59] + " y " + DIAS[1], "seiscientos " + DIAS[59] + " y " + DIAS[2], "seiscientos " + DIAS[59] + " y " + DIAS[3], "seiscientos " + DIAS[59] + " y " + DIAS[4], "seiscientos " + DIAS[59] + " y " + DIAS[5],
        "seiscientos " + DIAS[59] + " y " + DIAS[6], "seiscientos " + DIAS[59] + " y " + DIAS[7], "seiscientos " + DIAS[59] + " y " + DIAS[8], 'setenta');
    DIAS.push("seiscientos " + DIAS[69] + " y " + DIAS[0], "seiscientos " + DIAS[69] + " y " + DIAS[1], "seiscientos " + DIAS[69] + " y " + DIAS[2], "seiscientos " + DIAS[69] + " y " + DIAS[3], "seiscientos " + DIAS[69] + " y " + DIAS[4], "seiscientos " + DIAS[69] + " y " + DIAS[5],
        "seiscientos " + DIAS[69] + " y " + DIAS[6], "seiscientos " + DIAS[69] + " y " + DIAS[7], "seiscientos " + DIAS[69] + " y " + DIAS[8], 'ochenta');
    DIAS.push("seiscientos " + DIAS[79] + " y " + DIAS[0], "seiscientos " + DIAS[79] + " y " + DIAS[1], "seiscientos " + DIAS[79] + " y " + DIAS[2], "seiscientos " + DIAS[79] + " y " + DIAS[3], "seiscientos " + DIAS[79] + " y " + DIAS[4], "seiscientos " + DIAS[79] + " y " + DIAS[5],
        "seiscientos " + DIAS[79] + " y " + DIAS[6], "seiscientos " + DIAS[79] + " y " + DIAS[7], "seiscientos " + DIAS[79] + " y " + DIAS[8], 'noventa');
    DIAS.push("seiscientos " + DIAS[89] + " y " + DIAS[0], "seiscientos " + DIAS[89] + " y " + DIAS[1], "seiscientos " + DIAS[89] + " y " + DIAS[2], "seiscientos " + DIAS[89] + " y " + DIAS[3], "seiscientos " + DIAS[89] + " y " + DIAS[4], "seiscientos " + DIAS[89] + " y " + DIAS[5],
        "seiscientos " + DIAS[89] + " y " + DIAS[6], "seiscientos " + DIAS[89] + " y " + DIAS[7], "seiscientos " + DIAS[89] + " y " + DIAS[8], 'setecientos'); 
    
    DIAS.push("setecientos " + DIAS[0], "setecientos " + DIAS[1], "setecientos " + DIAS[2], "setecientos " + DIAS[3], "setecientos " + DIAS[4], "setecientos " + DIAS[5],
        "setecientos " + DIAS[6], "setecientos " + DIAS[7], "setecientos " + DIAS[8], "setecientos " + DIAS[9], "setecientos " + DIAS[10], "setecientos " + DIAS[11], "setecientos " + DIAS[12], "setecientos " + DIAS[13],
        "setecientos " + DIAS[14], "setecientos " + DIAS[15], "setecientos " + DIAS[16], "setecientos " + DIAS[17], "setecientos " + DIAS[18], "setecientos " + DIAS[19], "setecientos " + DIAS[20], "setecientos " + DIAS[21],
        "setecientos " + DIAS[22], "setecientos " + DIAS[23], "setecientos " + DIAS[24], "setecientos " + DIAS[25], "setecientos " + DIAS[26], "setecientos " + DIAS[27], "setecientos " + DIAS[28], "setecientos " + DIAS[29]);
    DIAS.push("setecientos " + DIAS[29] + " y " + DIAS[0], "setecientos " + DIAS[29] + " y " + DIAS[1], "setecientos " + DIAS[29] + " y " + DIAS[2], "setecientos " + DIAS[29] + " y " + DIAS[3], "setecientos " + DIAS[29] + " y " + DIAS[4], "setecientos " + DIAS[29] + " y " + DIAS[5],
        "setecientos " + DIAS[29] + " y " + DIAS[6], "setecientos " + DIAS[29] + " y " + DIAS[7], "setecientos " + DIAS[29] + " y " + DIAS[8], 'cuarenta');
    DIAS.push("setecientos " + DIAS[39] + " y " + DIAS[0], "setecientos " + DIAS[39] + " y " + DIAS[1], "setecientos " + DIAS[39] + " y " + DIAS[2], "setecientos " + DIAS[39] + " y " + DIAS[3], "setecientos " + DIAS[39] + " y " + DIAS[4], "setecientos " + DIAS[39] + " y " + DIAS[5],
        "setecientos " + DIAS[39] + " y " + DIAS[6], "setecientos " + DIAS[39] + " y " + DIAS[7], "setecientos " + DIAS[39] + " y " + DIAS[8], 'cincuenta');
    DIAS.push("setecientos " + DIAS[49] + " y " + DIAS[0], "setecientos " + DIAS[49] + " y " + DIAS[1], "setecientos " + DIAS[49] + " y " + DIAS[2], "setecientos " + DIAS[49] + " y " + DIAS[3], "setecientos " + DIAS[49] + " y " + DIAS[4], "setecientos " + DIAS[49] + " y " + DIAS[5],
        "setecientos " + DIAS[49] + " y " + DIAS[6], "setecientos " + DIAS[49] + " y " + DIAS[7], "setecientos " + DIAS[49] + " y " + DIAS[8], 'sesenta');
    DIAS.push("setecientos " + DIAS[59] + " y " + DIAS[0], "setecientos " + DIAS[59] + " y " + DIAS[1], "setecientos " + DIAS[59] + " y " + DIAS[2], "setecientos " + DIAS[59] + " y " + DIAS[3], "setecientos " + DIAS[59] + " y " + DIAS[4], "setecientos " + DIAS[59] + " y " + DIAS[5],
        "setecientos " + DIAS[59] + " y " + DIAS[6], "setecientos " + DIAS[59] + " y " + DIAS[7], "setecientos " + DIAS[59] + " y " + DIAS[8], 'setenta');
    DIAS.push("setecientos " + DIAS[69] + " y " + DIAS[0], "setecientos " + DIAS[69] + " y " + DIAS[1], "setecientos " + DIAS[69] + " y " + DIAS[2], "setecientos " + DIAS[69] + " y " + DIAS[3], "setecientos " + DIAS[69] + " y " + DIAS[4], "setecientos " + DIAS[69] + " y " + DIAS[5],
        "setecientos " + DIAS[69] + " y " + DIAS[6], "setecientos " + DIAS[69] + " y " + DIAS[7], "setecientos " + DIAS[69] + " y " + DIAS[8], 'ochenta');
    DIAS.push("setecientos " + DIAS[79] + " y " + DIAS[0], "setecientos " + DIAS[79] + " y " + DIAS[1], "setecientos " + DIAS[79] + " y " + DIAS[2], "setecientos " + DIAS[79] + " y " + DIAS[3], "setecientos " + DIAS[79] + " y " + DIAS[4], "setecientos " + DIAS[79] + " y " + DIAS[5],
        "setecientos " + DIAS[79] + " y " + DIAS[6], "setecientos " + DIAS[79] + " y " + DIAS[7], "setecientos " + DIAS[79] + " y " + DIAS[8], 'noventa');
    DIAS.push("setecientos " + DIAS[89] + " y " + DIAS[0], "setecientos " + DIAS[89] + " y " + DIAS[1], "setecientos " + DIAS[89] + " y " + DIAS[2], "setecientos " + DIAS[89] + " y " + DIAS[3], "setecientos " + DIAS[89] + " y " + DIAS[4], "setecientos " + DIAS[89] + " y " + DIAS[5],
        "setecientos " + DIAS[89] + " y " + DIAS[6], "setecientos " + DIAS[89] + " y " + DIAS[7], "setecientos " + DIAS[89] + " y " + DIAS[8], 'ochocientos'); 
    
    DIAS.push("ochocientos " + DIAS[0], "ochocientos " + DIAS[1], "ochocientos " + DIAS[2], "ochocientos " + DIAS[3], "ochocientos " + DIAS[4], "ochocientos " + DIAS[5],
        "ochocientos " + DIAS[6], "ochocientos " + DIAS[7], "ochocientos " + DIAS[8], "ochocientos " + DIAS[9], "ochocientos " + DIAS[10], "ochocientos " + DIAS[11], "ochocientos " + DIAS[12], "ochocientos " + DIAS[13],
        "ochocientos " + DIAS[14], "ochocientos " + DIAS[15], "ochocientos " + DIAS[16], "ochocientos " + DIAS[17], "ochocientos " + DIAS[18], "ochocientos " + DIAS[19], "ochocientos " + DIAS[20], "ochocientos " + DIAS[21],
        "ochocientos " + DIAS[22], "ochocientos " + DIAS[23], "ochocientos " + DIAS[24], "ochocientos " + DIAS[25], "ochocientos " + DIAS[26], "ochocientos " + DIAS[27], "ochocientos " + DIAS[28], "ochocientos " + DIAS[29]);
    DIAS.push("ochocientos " + DIAS[29] + " y " + DIAS[0], "ochocientos " + DIAS[29] + " y " + DIAS[1], "ochocientos " + DIAS[29] + " y " + DIAS[2], "ochocientos " + DIAS[29] + " y " + DIAS[3], "ochocientos " + DIAS[29] + " y " + DIAS[4], "ochocientos " + DIAS[29] + " y " + DIAS[5],
        "ochocientos " + DIAS[29] + " y " + DIAS[6], "ochocientos " + DIAS[29] + " y " + DIAS[7], "ochocientos " + DIAS[29] + " y " + DIAS[8], 'cuarenta');
    DIAS.push("ochocientos " + DIAS[39] + " y " + DIAS[0], "ochocientos " + DIAS[39] + " y " + DIAS[1], "ochocientos " + DIAS[39] + " y " + DIAS[2], "ochocientos " + DIAS[39] + " y " + DIAS[3], "ochocientos " + DIAS[39] + " y " + DIAS[4], "ochocientos " + DIAS[39] + " y " + DIAS[5],
        "ochocientos " + DIAS[39] + " y " + DIAS[6], "ochocientos " + DIAS[39] + " y " + DIAS[7], "ochocientos " + DIAS[39] + " y " + DIAS[8], 'cincuenta');
    DIAS.push("ochocientos " + DIAS[49] + " y " + DIAS[0], "ochocientos " + DIAS[49] + " y " + DIAS[1], "ochocientos " + DIAS[49] + " y " + DIAS[2], "ochocientos " + DIAS[49] + " y " + DIAS[3], "ochocientos " + DIAS[49] + " y " + DIAS[4], "ochocientos " + DIAS[49] + " y " + DIAS[5],
        "ochocientos " + DIAS[49] + " y " + DIAS[6], "ochocientos " + DIAS[49] + " y " + DIAS[7], "ochocientos " + DIAS[49] + " y " + DIAS[8], 'sesenta');
    DIAS.push("ochocientos " + DIAS[59] + " y " + DIAS[0], "ochocientos " + DIAS[59] + " y " + DIAS[1], "ochocientos " + DIAS[59] + " y " + DIAS[2], "ochocientos " + DIAS[59] + " y " + DIAS[3], "ochocientos " + DIAS[59] + " y " + DIAS[4], "ochocientos " + DIAS[59] + " y " + DIAS[5],
        "ochocientos " + DIAS[59] + " y " + DIAS[6], "ochocientos " + DIAS[59] + " y " + DIAS[7], "ochocientos " + DIAS[59] + " y " + DIAS[8], 'setenta');
    DIAS.push("ochocientos " + DIAS[69] + " y " + DIAS[0], "ochocientos " + DIAS[69] + " y " + DIAS[1], "ochocientos " + DIAS[69] + " y " + DIAS[2], "ochocientos " + DIAS[69] + " y " + DIAS[3], "ochocientos " + DIAS[69] + " y " + DIAS[4], "ochocientos " + DIAS[69] + " y " + DIAS[5],
        "ochocientos " + DIAS[69] + " y " + DIAS[6], "ochocientos " + DIAS[69] + " y " + DIAS[7], "ochocientos " + DIAS[69] + " y " + DIAS[8], 'ochenta');
    DIAS.push("ochocientos " + DIAS[79] + " y " + DIAS[0], "ochocientos " + DIAS[79] + " y " + DIAS[1], "ochocientos " + DIAS[79] + " y " + DIAS[2], "ochocientos " + DIAS[79] + " y " + DIAS[3], "ochocientos " + DIAS[79] + " y " + DIAS[4], "ochocientos " + DIAS[79] + " y " + DIAS[5],
        "ochocientos " + DIAS[79] + " y " + DIAS[6], "ochocientos " + DIAS[79] + " y " + DIAS[7], "ochocientos " + DIAS[79] + " y " + DIAS[8], 'noventa');
    DIAS.push("ochocientos " + DIAS[89] + " y " + DIAS[0], "ochocientos " + DIAS[89] + " y " + DIAS[1], "ochocientos " + DIAS[89] + " y " + DIAS[2], "ochocientos " + DIAS[89] + " y " + DIAS[3], "ochocientos " + DIAS[89] + " y " + DIAS[4], "ochocientos " + DIAS[89] + " y " + DIAS[5],
        "ochocientos " + DIAS[89] + " y " + DIAS[6], "ochocientos " + DIAS[89] + " y " + DIAS[7], "ochocientos " + DIAS[89] + " y " + DIAS[8], 'novecientos'); 

    var mes = MESES[date.getMonth()];
    var dia = DIAS[date.getDate()];
    // console.log(date);
    console.log(dia+" de "+ mes);
    debugger
    
    
} 

function fillField(fname,info, dpi_field, name_field, label_id){
    // debugger
    var dpi_p = /\d{4} \d{5} \d{4}/g;
    var dpi = info.match(dpi_p);
    var findpi = info.search(dpi[0]) + 15;
    info = info.substring(findpi);
    info = info.substring(info.search("BRE")+4);
    var name = info.match(/[A-Z]+ [A-Z]+/g);
    setTimeout(() => {
        document.getElementById(label_id).title=fname;
        document.getElementById(dpi_field).value = dpi[0];
        document.getElementById(name_field).value = name[0];
        console.log(dpi_field+": "+dpi[0]);
    }, 1000);
}

function fixDate(stringdate){
    let goodDate = moment(stringdate);
    let findate = goodDate.date() + " de " + MESES[goodDate.month()] + " de " +goodDate.year();
    return findate;
}


function setValues(date, nname, sname, dpi){
    let fecha = document.getElementById(date).value;
    // console.log(fecha);
    d = document.getElementById('fecha_emision');
    nn = document.getElementById('name1');
    sn = document.getElementById('name2');
    dp = document.getElementById('DPI');
    d.innerText = fixDate(fecha);
    nn.innerText = document.getElementById(nname).value;
    sn.innerText = document.getElementById(sname).value;
    dp.innerText = document.getElementById(dpi).value;
    
}

function setTodaysDate(input_id_element){
    var fecha_field = document.getElementById(input_id_element);
    var fecha_hoy = new Date();
    var año = fecha_hoy.getFullYear();
    var mes = fecha_hoy.getMonth() + 1;
    var dia = fecha_hoy.getDate();
    var fecha_formateada = año + "-" + mes + "-" + dia;
    fecha_field.value = fecha_formateada;
}

function formatDate(fecha_field){
    var fecha_hoy = new Date(fecha_field);
    var año = fecha_hoy.getFullYear();
    var mes = fecha_hoy.getMonth() + 1;
    var dia = fecha_hoy.getDate();
    var fecha_formateada = año + "-" + mes + "-" + dia;
    return fecha_formateada;
}


Date.daysBetween = function( date1, date2 ) {
  //Get 1 day in milliseconds
  var one_day=1000*60*60*24;

  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  // Calculate the difference in milliseconds
  var difference_ms = date2_ms - date1_ms;
    
  // Convert back to days and return
  return Math.round(difference_ms/one_day); 
}

function setValues_cartadepoder(inputdate,nombre_a_dar, nombre_a_recibir, responsabilidades, DPI_otorgante, DPI_apoderado, DPI_testigo1, DPI_testigo2, fecha_final)
{
	//INPUTS
	var fecha_inicio = document.getElementById(inputdate).value;
	var nombre_a_dar = document.getElementById(nombre_a_dar).value;
	var nombre_a_recibir = document.getElementById(nombre_a_recibir).value;
	var responsabilidades = document.getElementById(responsabilidades).value;
	var DPI_otorgante = document.getElementById(DPI_otorgante).value;
	var DPI_apoderado = document.getElementById(DPI_apoderado).value;
	var DPI_testigo1 = document.getElementById(DPI_testigo1).value;
	var DPI_testigo2 = document.getElementById(DPI_testigo2).value;
	var fecha_final = document.getElementById(fecha_final).value;
	fecha_inicio_como_date = new Date(fecha_inicio);
	fecha_final_como_date = new Date(fecha_final);
	var diferencia = Math.abs(fecha_final_como_date - fecha_inicio_como_date);
	console.log(diferencia);
	var diferencia_endias = Date.daysBetween(fecha_inicio_como_date, fecha_final_como_date);
	console.log(diferencia_endias);


	//MARKS
	var fecha_emision = document.getElementById("fecha_emision");
	var nombre_otorgante = document.getElementById("nombre_otorgante");
	var nombre_apoderado = document.getElementById("nombre_apoderado");
	var responsabilidadesm = document.getElementById("responsabilidadesm");
	var DPI_otorgantem = document.getElementById("DPI_otorgantem");
	var DPI_apoderadom = document.getElementById("DPI_apoderadom");
	var DPI_testigo1m = document.getElementById("DPI_testigo1m");
	var DPI_testigo2m = document.getElementById("DPI_testigo2m");
	var cantidad_diasm = document.getElementById("cantidad_diasm");
	var fecha_finalm = document.getElementById("fecha_finalm");


	fecha_emision.innerText = fixDate(fecha_inicio);
	nombre_otorgante.innerText = nombre_a_dar;
	nombre_apoderado.innerText = nombre_a_recibir;
	responsabilidadesm.innerText = responsabilidades;
	DPI_otorgantem.innerText = DPI_otorgante;
	DPI_apoderadom.innerText = DPI_apoderado;
	DPI_testigo1m.innerText = DPI_testigo1;
	DPI_testigo2m.innerText = DPI_testigo2;
	cantidad_diasm.innerText = diferencia_endias;
	fecha_finalm.innerText = fixDate(fecha_final);
}

function setValues_actadedeclaracion(inputdate, notario_name, direccion, affected_name, affected_DPI, institucion, solicitud)
{
    //  INPUTS
    debugger
    var fecha_inicio = document.getElementById(inputdate).value;
    var nombre_notario = document.getElementById(notario_name).value;
    var direccion = document.getElementById(direccion).value;
    var nombre_solicitante = document.getElementById(affected_name).value;
    var dpi_solicitante = document.getElementById(affected_DPI).value;
    var institucion = document.getElementById(institucion).value;
    var solicitud = document.getElementById(solicitud).value;

    //MARKS
    var fecha_emision = document.getElementById("fecha_emisionm");
    var nombre_notariom = document.getElementById("nombre_notariom");
    var direccionm = document.getElementById("direccionm");
    var nombre_solicitantem = document.getElementById("nombre_solicitantem");
    var dpi_solicitantem = document.getElementById("dpi_solicitantem");
    var nombre_solicitante2m = document.getElementById("nombre_solicitante2m");
    var institucion_a_solicitarm = document.getElementById("institucion_a_solicitarm");
    var solicitudm = document.getElementById("solicitudm");

    fecha_emision.innerText = fixDate(fecha_inicio);
    nombre_notariom.innerText = nombre_notario;
    direccionm.innerText = direccion;
    nombre_solicitantem.innerText = nombre_solicitante;
    dpi_solicitantem.innerText = dpi_solicitante;
    nombre_solicitante2m.innerText = nombre_solicitante;
    institucion_a_solicitarm.innerText = institucion;
    solicitudm.innerText = solicitud;

}

function setValues_declaracionjurada(fecha_emision,notario_name, direccion, affected_name, affected_DPI, nombre_entidad, fecha_emision_actanotarial, nombre_notario_actanotarial, empresa_afectada)
{
    //  INPUTS
    //debugger
    var fecha_emision = document.getElementById(fecha_emision).value;
    var notario_name = document.getElementById(notario_name).value;
    var direccion = document.getElementById(direccion).value;
    var affected_name = document.getElementById(affected_name).value;
    var affected_DPI = document.getElementById(affected_DPI).value;
    var nombre_entidad = document.getElementById(nombre_entidad).value;
    var fecha_emision_actanotarial = document.getElementById(fecha_emision_actanotarial).value;
    var nombre_notario_actanotarial = document.getElementById(nombre_notario_actanotarial).value;
    var empresa_afectada = document.getElementById(empresa_afectada).value;

    //MARKS
    var fecha_emisionm = document.getElementById("fecha_emisionm");
    var nombre_notariom = document.getElementById("nombre_notariom");
    var direccionm = document.getElementById("direccionm");
    var nombre_solicitantem = document.getElementById("nombre_solicitantem");
    var dpi_solicitantem = document.getElementById("dpi_solicitantem");
    var nombre_entidadm = document.getElementById("nombre_entidadm");
    var fecha_emision_actanotarialm = document.getElementById("fecha_emision_actanotarialm");
    var nombre_notario_actanotarialm = document.getElementById("nombre_notario_actanotarialm");
    var nombre_entidad2m = document.getElementById("nombre_entidad2m");
    var empresa_afectadam = document.getElementById("empresa_afectadam");
    var empresa_afectada2m = document.getElementById("empresa_afectada2m");

    fecha_emisionm.innerText = fixDate(fecha_emision);
    nombre_notariom.innerText = notario_name;
    direccionm.innerText = direccion;
    nombre_solicitantem.innerText = affected_name;
    dpi_solicitantem.innerText = affected_DPI;
    nombre_entidadm.innerText = nombre_entidad;
    fecha_emision_actanotarialm.innerText = fixDate(fecha_emision_actanotarial);
    nombre_notario_actanotarialm.innerText = nombre_notario_actanotarial;
    nombre_entidad2m.innerText = nombre_entidad;
    empresa_afectadam.innerText = empresa_afectada;
    empresa_afectada2m.innerText = empresa_afectada;
}

function setValues_declaracionjurada_SAT(fecha_emision,notario_name, direccion, affected_name, affected_DPI, affected_NIT, nombre_entidad, nit_entidad, direccion_entidad, departamento_entidad, municipio_entidad, cantidad_del_pago, fecha_del_pago, numero_formulario_SAT)
{
    //INPUTS
    var fecha_emision = document.getElementById(fecha_emision).value;
    var notario_name = document.getElementById(notario_name).value;
    var direccion = document.getElementById(direccion).value;
    var affected_name = document.getElementById(affected_name).value;
    var affected_DPI = document.getElementById(affected_DPI).value;
    var affected_NIT = document.getElementById(affected_NIT).value;
    var nombre_entidad = document.getElementById(nombre_entidad).value;
    var nit_entidad = document.getElementById(nit_entidad).value;
    var direccion_entidad = document.getElementById(direccion_entidad).value;
    var departament_entidad = document.getElementById(departamento_entidad).value;
    var municipio_entidad = document.getElementById(municipio_entidad).value;
    var cantidad_del_pago = document.getElementById(cantidad_del_pago).value;
    var fecha_del_pago = document.getElementById(fecha_del_pago).value;
    var numero_formulario_SAT = document.getElementById(numero_formulario_SAT).value;

    //MARKS
    var fecha_emisionm = document.getElementById("fecha_emisionm");
    var nombre_notariom = document.getElementById("nombre_notariom");
    var direccionm = document.getElementById("direccionm");
    var nombre_solicitantem = document.getElementById("nombre_solicitantem");
    var dpi_solicitantem = document.getElementById("dpi_solicitantem");
    var NIT_solicitantem = document.getElementById("NIT_solicitantem");
    var nombre_entidadm = document.getElementById("nombre_entidadm");
    var nombre_entidad2m = document.getElementById("nombre_entidad2m");
    var NIT_entidadm = document.getElementById("NIT_entidadm");
    var direccion_entidadm = document.getElementById("direccion_entidadm");
    var departamento_entidadm = document.getElementById("departamento_entidadm");
    var municipio_entidadm = document.getElementById("municipio_entidadm");
    var cantidad_del_pagom = document.getElementById("cantidad_del_pagom");
    var fecha_del_pagom = document.getElementById("fecha_del_pagom");
    var numero_formulario_SATm = document.getElementById("numero_formulario_SATm");
    var cantidad_del_pago2m = document.getElementById("cantidad_del_pago2m"); 

    fecha_emisionm.innerText = fixDate(fecha_emision);
    nombre_notariom.innerText = notario_name;
    direccionm.innerText = direccion;
    nombre_solicitantem.innerText = affected_name;
    dpi_solicitantem.innerText = affected_DPI;
    NIT_solicitantem.innerText = affected_NIT;
    nombre_entidadm.innerText = nombre_entidad;
    nombre_entidad2m.innerText = nombre_entidad;
    NIT_entidadm.innerText = nit_entidad;
    direccion_entidadm.innerText = direccion_entidad;
    departamento_entidadm.innerText = departament_entidad;
    municipio_entidadm.innerText = municipio_entidad;
    cantidad_del_pagom.innerText = cantidad_del_pago;
    fecha_del_pagom.innerText = fixDate(fecha_del_pago);
    numero_formulario_SATm.innerText = numero_formulario_SAT;
    cantidad_del_pago2m.innerText = cantidad_del_pago;

}

function setValues_ampliacion(fecha_emision,nombre_notario, numero_escritura, fecha_autorizacion, contenido_escritura, nombre_solicitante, tipo_documento, numero_documento, ampliacion)
{
    //INPUTS
    var fecha_emision = document.getElementById(fecha_emision).value;
    var nombre_notario = document.getElementById(nombre_notario).value;
    var numero_escritura = document.getElementById(numero_escritura).value;
    var fecha_autorizacion = document.getElementById(fecha_autorizacion).value;
    var contenido_escritura = document.getElementById(contenido_escritura).value;
    var nombre_solicitante = document.getElementById(nombre_solicitante).value;
    var tipo_documento = document.getElementById(tipo_documento).value;
    var numero_documento = document.getElementById(numero_documento).value;
    var ampliacion = document.getElementById(ampliacion).value;

    //MARKS
    var fecha_emisionm = document.getElementById("fecha_emisionm");
    var nombre_notariom = document.getElementById("nombre_notariom");
    var numero_escrituram = document.getElementById("numero_escrituram");
    var fecha_autorizacionm = document.getElementById("fecha_autorizacionm");
    var contenido_escrituram = document.getElementById("contenido_escrituram");
    var nombre_solicitantem = document.getElementById("nombre_solicitantem");
    var tipo_documentom = document.getElementById("tipo_documentom");
    var numero_documentom = document.getElementById("numero_documentom");
    var ampliacionm = document.getElementById("ampliacionm");
    var nombre_solicitante2m = document.getElementById("nombre_solicitante2m");
    var numero_escritura2m = document.getElementById("numero_escritura2m");
    var fecha_autorizacion2m = document.getElementById("fecha_autorizacion2m");


    fecha_emisionm.innerText = fixDate(fecha_emision);
    nombre_notariom.innerText = nombre_notario;
    numero_escrituram.innerText = numero_escritura;
    fecha_autorizacionm.innerText = fixDate(fecha_autorizacion);
    contenido_escrituram.innerText = contenido_escritura;
    nombre_solicitantem.innerText = nombre_solicitante;
    tipo_documentom.innerText = tipo_documento;
    numero_documentom.innerText = numero_documento;
    ampliacionm.innerText = ampliacion;
    nombre_solicitante2m.innerText = nombre_solicitante;
    numero_escritura2m.innerText = numero_escritura;
    fecha_autorizacion2m.innerText = fixDate(fecha_autorizacion);
}

function setValues_nombramiento(nombre_entidad,fecha_emision, nombre_notario, direccion, nombre_solicitante, dpi_solicitante, numero_escritura, notario_escritura, fecha_autorizacion, actividades, numero_acta, fecha_acta, plazo_enaños)
{

    //INPUTS
    var nombre_entidad = document.getElementById(nombre_entidad).value;
    var fecha_emision = document.getElementById(fecha_emision).value;
    var nombre_notario = document.getElementById(nombre_notario).value;
    var direccion = document.getElementById(direccion).value;
    var nombre_solicitante = document.getElementById(nombre_solicitante).value;
    var dpi_solicitante = document.getElementById(dpi_solicitante).value;
    var numero_escritura = document.getElementById(numero_escritura).value;
    var notario_escritura = document.getElementById(notario_escritura).value;
    var fecha_autorizacion = document.getElementById(fecha_autorizacion).value;
    var actividades = document.getElementById(actividades).value;
    var numero_acta = document.getElementById(numero_acta).value;
    var fecha_acta = document.getElementById(fecha_acta).value;
    var plazo_enaños = document.getElementById(plazo_enaños).value;

    //MARKS
    var nombre_entidadm = document.getElementById("nombre_entidadm");
    var fecha_emisionm = document.getElementById("fecha_emisionm");
    var nombre_notariom = document.getElementById("nombre_notariom");
    var direccionm = document.getElementById("direccionm");
    var nombre_solicitantem = document.getElementById("nombre_solicitantem");
    var dpi_solicitantem = document.getElementById("dpi_solicitantem");
    var nombre_entidad2m = document.getElementById("nombre_entidad2m");
    var nombre_entidad3m = document.getElementById("nombre_entidad3m");
    var numero_escrituram = document.getElementById("numero_escrituram");
    var notario_escrituram = document.getElementById("notario_escrituram");
    var fecha_autorizacionm = document.getElementById("fecha_autorizacionm");
    var actividadesm = document.getElementById("actividadesm");
    var numero_actam = document.getElementById("numero_actam");
    var nombre_entidad4m = document.getElementById("nombre_entidad4m");
    var fecha_actam = document.getElementById("fecha_actam");
    var nombre_solicitante2m = document.getElementById("nombre_solicitante2m");
    var nombre_entidad5m = document.getElementById("nombre_entidad5m");
    var plazo_enañosm = document.getElementById("plazo_enañosm");
    var nombre_entidad6m = document.getElementById("nombre_entidad6m");
    var nombre_solicitante3m = document.getElementById("nombre_solicitante3m");

    nombre_entidadm.innerText = nombre_entidad;
    fecha_emisionm.innerText = fixDate(fecha_emision);
    nombre_notariom.innerText = nombre_notario;
    direccionm.innerText = direccion;
    nombre_solicitantem.innerText = nombre_solicitante;
    dpi_solicitantem.innerText = dpi_solicitante;
    nombre_entidad2m.innerText = nombre_entidad;
    nombre_entidad3m.innerText = nombre_entidad;
    numero_escrituram.innerText = numero_escritura;
    notario_escrituram.innerText = notario_escritura;
    fecha_autorizacionm.innerText = fixDate(fecha_autorizacion);
    actividadesm.innerText = actividades;
    numero_actam.innerText = numero_acta;
    nombre_entidad4m.innerText = nombre_entidad;
    fecha_actam.innerText = fixDate(fecha_acta);
    nombre_solicitante2m.innerText = nombre_solicitante;
    nombre_entidad5m.innerText = nombre_entidad;
    plazo_enañosm.innerText = plazo_enaños;
    nombre_entidad6m.innerText = nombre_entidad;
    nombre_solicitante3m.innerText = nombre_solicitante;
    
}