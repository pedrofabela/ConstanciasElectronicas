/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package action;
import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import java.util.regex.Pattern;
import org.apache.struts2.interceptor.SessionAware;
/**
 *
 * @author jezieel
 */
public class validacion_constancia extends ActionSupport implements SessionAware{
    
    public static void main(String[] args) {
        //System.out.println("ROLA040927HMCDNBA9   "+validarCURP("ROLA040927HMCDNBA9")); //true
        //System.out.println("1 kjbds              "+validarCURP("1")); //false
        String v1="ROLA040927HMCDNBA9";
        String v2="R1";
        if (validarCURP(v2)==true) {
            System.out.println("Si es una curp");
        }else{
            System.out.println("No es una curp");
        }
        
        String a1="15EPR0304R";
        String a2="20EPR0304F";
        if (validarCct(a1)==true) {
            System.out.println("Si es una CCT");
        }else{
            System.out.println("No es una CCT");
        }
    }
    
    
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
            
              
            //
            
            
    }
    @Override
    public void setSession(Map<String, Object> map) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
}
