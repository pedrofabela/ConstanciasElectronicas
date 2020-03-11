/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package action;

import static action.validacion_constancia.validarCURP;
import static action.validacion_constancia.validarCct;
import beans.datosBean;
import beans.moduloAuxBean;
import beans.moduloBean;
import beans.usuarioBean;
import com.opensymphony.xwork2.ActionSupport;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;

/**
 *
 * @author pedro
 */
public class Consultas_Action extends ActionSupport implements SessionAware {
    
    private usuarioBean usuariocons;
    private String cveusuario;
    private String pasusuario;
    private String nomModulo;
    private String modulo;
    private String nombreUsuario;
    private String tabSelect;
    
    
    private String TipoError;
    private String TipoException;
    
    public String curp;
    public String cct;
    public int opcion_constancia;
    public boolean avisos=false;
    
    //variables de cct y curps
    
    //Preescolar
    public String curp_pre_pri_grado = "ROLA040927HMCDNBA9";
    public String cct_pre_pri_grado = "15EJN2273L";
    public String curp_pre_seg_grado = "MAGA041210HMCRNRA4";
    public String cct_pre_seg_grado = "15EJN3979F";

    //Primaria
    public String curp_pri_pri_grado = "MAGG041007MMCRTRA5";
    public String cct_pri_pri_grado = "15EPR1210J";
    public String curp_pri_cua_grado = "MEDA030901HMCNNBA9";
    public String cct_pri_cua_grado = "15EPR1210J";


    //Secundaria
    public String curp_sec_pri_grado = "ROAR040603HMCDDNA8";
    public String cct_sec_pri_grado = "15EES0666U";
    public String curp_sec_ter_grado = "SAAR020708MOCNRQA2";
    public String cct_sec_ter_grado = "15EES0666U";

    //Media superior
    public String curp_ms_pri_grado = "AOTR041003HMCZPLA5";
    public String cct_ms_pri_grado = "15EBH0100N";
    public String curp_ms_sex_grado = "TOGE850412MMCLVL02";
    public String cct_ms_sex_grado = "15EBH0340M";

    //Normal y superior
    public String curp_sup_ter_grado = "CEGY041120MMCRRRB0";
    public String cct_sup_ter_grado = "15XXU9034Q";
    
    
    
    
    
    
    
    datosBean datos=new datosBean();
 



    public List<moduloBean> modulosAUX = new ArrayList<moduloBean>();
    public List<moduloAuxBean> modulosAUXP = new ArrayList<moduloAuxBean>();
    
    
   private Map session;

    public void setSession(Map session) {
        this.session = session;
    }

    public Map getSession() {
        return session;
    }
    
    
 
    
    public String validarDatos() {

        //validando session***********************************************************************
        
        curp=datos.getCURP();
        cct=datos.getCCT();
        avisos=datos.isAVISOS();
        
        
        
        
        
        
        if(validarCURP(curp)!=true || validarCct(cct)!=true || avisos==false){
            if (validarCURP(curp)!=true) {
                addFieldError("ERRORDATOS", "Escriba una CURP correcta para el estudiante");
            }
            if (validarCct(cct)!=true) {
                addFieldError("ERRORDATOS", "La Clave de Centro de Trabajo es incorrecta");
            }
            if (avisos==false) {
                addFieldError("ERRORDATOS", "Debe leer y aceptar el Aviso de privacidad");
            }
            
        }else{
            validar_datos_ingresados();
            try {    
            
            System.out.println(opcion_constancia);
            
            switch(opcion_constancia){
                case 1: return "CONSTANCIA_PRE_PRI";
                case 2: return "CONSTANCIA_PRE_SEG";
                case 3: return "CONSTANCIA_PRI_PRI";
                case 4: return "CONSTANCIA_PRI_CUA";
                case 5: return "CONSTANCIA_SEC_PRI";
                case 6: return "CONSTANCIA_SEC_TER";
                case 7: return "CONSTANCIA_MS_PRI";
                case 8: return "CONSTANCIA_MS_SEX";
                case 9: return "CONSTANCIA_SUP_TER";
                default: 
                    addFieldError("ERRORDATOS", "No se encontrarón datos acerca del alumno, verifique los datos ingresados");
                    return "SUCCESS";
                    
            }
        } catch (Exception e) {

            TipoException = e.getMessage();
            return "ERROR";
        }
        }

        //System.out.println(curp);
        //System.out.println(cct);
        
        
        try {    
            /**/
            System.out.println(opcion_constancia);
            /*
            switch(opcion_constancia){
                case 1: return "CONSTANCIA_PRE_PRI";
                case 2: return "CONSTANCIA_PRE_SEG";
                case 3: return "CONSTANCIA_PRI_PRI";
                case 4: return "CONSTANCIA_PRI_CUA";
                case 5: return "CONSTANCIA_SEC_PRI";
                case 6: return "CONSTANCIA_SEC_TER";
                case 7: return "CONSTANCIA_MS_PRI";
                case 8: return "CONSTANCIA_MS_SEX";
                case 9: return "CONSTANCIA_SUP_TER";
                default: 
                    //addFieldError("ERRORDATOS", "No se encontrarón datos acerca del alumno");
                    return "SUCCESS";
            }*/
            return "SUCCESS";
        } catch (Exception e) {

            TipoException = e.getMessage();
            return "ERROR";
        }
    } 

    public usuarioBean getUsuariocons() {
        return usuariocons;
    }

    public void setUsuariocons(usuarioBean usuariocons) {
        this.usuariocons = usuariocons;
    }

    public String getCveusuario() {
        return cveusuario;
    }

    public void setCveusuario(String cveusuario) {
        this.cveusuario = cveusuario;
    }

    public String getPasusuario() {
        return pasusuario;
    }

    public void setPasusuario(String pasusuario) {
        this.pasusuario = pasusuario;
    }

    public String getNomModulo() {
        return nomModulo;
    }

    public void setNomModulo(String nomModulo) {
        this.nomModulo = nomModulo;
    }

    public String getModulo() {
        return modulo;
    }

    public void setModulo(String modulo) {
        this.modulo = modulo;
    }

    public String getNombreUsuario() {
        return nombreUsuario;
    }

    public void setNombreUsuario(String nombreUsuario) {
        this.nombreUsuario = nombreUsuario;
    }

    public String getTabSelect() {
        return tabSelect;
    }

    public void setTabSelect(String tabSelect) {
        this.tabSelect = tabSelect;
    }

    public String getTipoError() {
        return TipoError;
    }

    public void setTipoError(String TipoError) {
        this.TipoError = TipoError;
    }

    public String getTipoException() {
        return TipoException;
    }

    public void setTipoException(String TipoException) {
        this.TipoException = TipoException;
    }

    public datosBean getDatos() {
        return datos;
    }

    public void setDatos(datosBean datos) {
        this.datos = datos;
    }

    public List<moduloBean> getModulosAUX() {
        return modulosAUX;
    }

    public void setModulosAUX(List<moduloBean> modulosAUX) {
        this.modulosAUX = modulosAUX;
    }

    public List<moduloAuxBean> getModulosAUXP() {
        return modulosAUXP;
    }

    public void setModulosAUXP(List<moduloAuxBean> modulosAUXP) {
        this.modulosAUXP = modulosAUXP;
    }
    
    /*
    public static boolean validarCURP(String curp){ 
            String regex =
            "[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}" +
            "(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])" +
            "[HM]{1}" +
            "(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)" +
            "[B-DF-HJ-NP-TV-Z]{3}" +
            "[0-9A-Z]{1}[0-9]{1}$";
            Pattern patron = Pattern.compile(regex);
            if(!patron.matcher(curp).matches())
            { return false;
            }else
            { return true;
        }
    }
    
        public static boolean validarCct(String cct){ 
            //CIML980829HMCNRS06
            //15 + EPR + 0304 + R
            //nn.LLL.nnnn.L
            String reggueton = "[15]{2}[A-Z]{3}[0-9]{4}[A-Z]{1}$";
            Pattern patron = Pattern.compile(reggueton);
            if(!patron.matcher(cct).matches())
            { return false;
            }else
            { return true;
            }
        }*/
        
        public void validar_datos_ingresados(){
            //Preescolar
        if(curp.equals(curp_pre_pri_grado) && cct.equals(cct_pre_pri_grado)){
            System.out.println("Preescolar");
            opcion_constancia=1;
        }
        if(curp.equals(curp_pre_seg_grado) && cct.equals(cct_pre_seg_grado)){
            System.out.println("Preescolar");
            opcion_constancia=2;
        }
        //Primaria
        if(curp.equals(curp_pri_pri_grado) && cct.equals(cct_pri_pri_grado)){
            System.out.println("Primaria");
            opcion_constancia=3;
        }
        if(curp.equals(curp_pri_cua_grado) && cct.equals(cct_pri_cua_grado)){
            System.out.println("Primaria");
            opcion_constancia=4;
        }
        //Secundaria
        if(curp.equals(curp_sec_pri_grado) && cct.equals(cct_sec_pri_grado)){
            System.out.println("Secundaria");
            opcion_constancia=5;
        }
        if(curp.equals(curp_sec_ter_grado) && cct.equals(cct_sec_ter_grado)){
            System.out.println("Secundaria");
            opcion_constancia=6;
        }
        //Media superior
        if(curp.equals(curp_ms_pri_grado) && cct.equals(cct_ms_pri_grado)){
            System.out.println("Media superior");
            opcion_constancia=7;
        }
        if(curp.equals(curp_ms_sex_grado) && cct.equals(cct_ms_sex_grado)){
            System.out.println("Media superior");
            opcion_constancia=8;
        }
        //Superior
        if(curp.equals(curp_sup_ter_grado) && cct.equals(cct_sup_ter_grado)){
            System.out.println("Superior");
            opcion_constancia=9;
        }
        
        
        
        
        }
    
}
