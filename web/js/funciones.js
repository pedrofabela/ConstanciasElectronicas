// JavaScript Document
function validar_rfc(rfc) {
	aceptarGenerico = true;
	const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
	var   validado = rfc.match(re);

	if (!validado) return false;
	const digitoVerificador = validado.pop(),
				rfcSinDigito      = validado.slice(1).join(''),
				len               = rfcSinDigito.length,
				diccionario       = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
				indice            = len + 1;
	var   suma,
				digitoEsperado;

	if (len == 12) suma = 0
	else suma = 481; //Ajuste para persona moral

	for(var i=0; i<len; i++)
			suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
	digitoEsperado = 11 - suma % 11;
	if (digitoEsperado == 11) digitoEsperado = 0;
	else if (digitoEsperado == 10) digitoEsperado = "A";

	if ((digitoVerificador != digitoEsperado)
	 && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
			return false;
	else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
			return false;
		
	//return rfcSinDigito + digitoVerificador;
	else return true

}

function validar_rfc_min(rfc) {
	const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
	var   validado = rfc.match(re);

	if (validado) return true;
	else return false
}

function validar_cct_min(cct) {
	const re = /^(\d{2})?([A-ZÑ&]{3})?(\d{4})?([A-ZÑ&]{1})$/;
	var validado = cct.match(re);

	if (validado) return true;
	else return false
}


function validar_curp(curp) {
	var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
			validado = curp.match(re);

	if (!validado)	return false;
	
	function digitoVerificador(curp17) {
			var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
					lngSuma      = 0.0,
					lngDigito    = 0.0;
			for(var i=0; i<17; i++)
					lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
			lngDigito = 10 - lngSuma % 10;
			if (lngDigito == 10) return 0;
			return lngDigito;
	}

	if (validado[2] != digitoVerificador(validado[1])) return false;
	return true;
}