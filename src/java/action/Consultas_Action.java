/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package action;

import beans.datosBean;
import beans.moduloAuxBean;
import beans.moduloBean;
import beans.usuarioBean;
import com.opensymphony.xwork2.ActionSupport;
import java.awt.Desktop;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Iterator;
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
    
    public String CurpMs="AOTR041003HMCZPLA5";
    public String CctMs="15EBH0100N";

    
    
     private String TipoError;
    private String TipoException;
    
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
 
        try {         
            System.out.println("CURP"+datos.getCURP()); 
               System.out.println("CCT"+datos.getCCT()); 
               System.out.println("TIPO"+datos.getTIPO()); 
        String a=datos.getCURP();
        String b=datos.getCCT();
               
      String Curp="CHIDO";
      String Cct="CHIDO";

               
               if (a.equals(Curp) && b.equals(Cct)) {
//abre el archivo
                   try {
                 File path = new File ("/home/gobierno/Descargas/hola.pdf");
                 Desktop.getDesktop().open(path);
                        }catch (IOException ex) {
                 ex.printStackTrace();
                                    }
               }else{
                   addFieldError("ERRORDATOS", "No se encontrarón datos");
               }
               
            
            
            
            
          

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
    
    
    
    
}
