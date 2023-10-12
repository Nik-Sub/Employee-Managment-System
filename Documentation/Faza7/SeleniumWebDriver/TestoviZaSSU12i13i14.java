package testPackages;

import java.time.Duration;
import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.testng.Assert;
import org.testng.annotations.AfterTest;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;


public class TestoviZaSSU12i13i14 {
	WebDriver driver = null;
	
	@BeforeTest
    public void pre() throws Exception{
        driver = (WebDriver) new FirefoxDriver(); // verzija drivera kompatibilna sa verzijom drajvera
        String putanja = "http://localhost:8000";
        driver.get(putanja);
    }
	
	
	@Test
    public void testPravljenjeRola() throws Exception {
        
        WebDriverWait cekaj = new WebDriverWait(driver, Duration.ofSeconds(10));
        
        WebElement user = cekaj.until(ExpectedConditions.elementToBeClickable(By.name("email")));
        
        user.clear();
        user.sendKeys("uros@gmail.com");
        WebElement psw = driver.findElement(By.name("password"));
        psw.clear();
        psw.sendKeys("uros123");
        WebElement dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.cssSelector("input[type='submit']")));
        dugme.click();
        
        //driver.manage().timeouts().implicitlyWait(7, TimeUnit.SECONDS);
        Thread.sleep(1000);
        
        //link for roles
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//html/body/div/ul/li[4]/a")));
        dugme.click();
        
        // button to make new role
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//html/body/section/a")));
        dugme.click();
        
        // enter name for role
        WebElement role = cekaj.until(ExpectedConditions.elementToBeClickable(By.name("name")));
        
        role.clear();
        role.sendKeys("novaRola");
        
        WebElement dugmeKreirajRolu = cekaj.until(ExpectedConditions.elementToBeClickable(By.cssSelector("button[type='submit']")));
        dugmeKreirajRolu.click();
        
        String poruka = driver.findElement(By.xpath("//html/body/section/div[4]/div[2]/h3")).getText();
        
        
        //Assert.assertTrue(poruka.contains("PRODUCTS"));
        Assert.assertEquals("novaRola", poruka);
        //driver.quit();
        
        
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"log_out\"]")));
        dugme.click();
    }
	
	@Test
    public void testPregledRola() throws Exception {
        
        WebDriverWait cekaj = new WebDriverWait(driver, Duration.ofSeconds(10));
        
        WebElement user = cekaj.until(ExpectedConditions.elementToBeClickable(By.name("email")));
        
        user.clear();
        user.sendKeys("uros@gmail.com");
        WebElement psw = driver.findElement(By.name("password"));
        psw.clear();
        psw.sendKeys("uros123");
        WebElement dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.cssSelector("input[type='submit']")));
        dugme.click();
        
        //driver.manage().timeouts().implicitlyWait(7, TimeUnit.SECONDS);
        Thread.sleep(1000);
        
        //link for roles
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//html/body/div/ul/li[4]/a")));
        dugme.click();
        
        String poruka = driver.findElement(By.xpath("//html/body/section/h1")).getText();
        
        
        //Assert.assertTrue(poruka.contains("PRODUCTS"));
        Assert.assertEquals("ALL ROLES", poruka);
        //driver.quit();
        
        
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"log_out\"]")));
        dugme.click();
    }
	
	@Test
    public void testLoginAdmin() throws Exception {
        
        WebDriverWait cekaj = new WebDriverWait(driver, Duration.ofSeconds(10));
        
        WebElement user = cekaj.until(ExpectedConditions.elementToBeClickable(By.name("email")));
        
        user.clear();
        user.sendKeys("uros@gmail.com");
        WebElement psw = driver.findElement(By.name("password"));
        psw.clear();
        psw.sendKeys("uros123");
        WebElement dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.cssSelector("input[type='submit']")));
        dugme.click();
        
        //driver.manage().timeouts().implicitlyWait(7, TimeUnit.SECONDS);
        Thread.sleep(1000);
        
        //link for roles
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//html/body/div/ul/li[4]/a")));
        dugme.click();
        
        
        String poruka = driver.findElement(By.xpath("//html/body/section/h1")).getText();
        
        
        //Assert.assertTrue(poruka.contains("PRODUCTS"));
        Assert.assertEquals("ALL ROLES", poruka);
        //driver.quit();
        
        
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"log_out\"]")));
        dugme.click();
    }
	
	@Test
    public void testLoginManager() throws Exception {
        
        WebDriverWait cekaj = new WebDriverWait(driver, Duration.ofSeconds(10));
        
        WebElement user = cekaj.until(ExpectedConditions.elementToBeClickable(By.name("email")));
        
        user.clear();
        user.sendKeys("nikola@gmail.com");
        WebElement psw = driver.findElement(By.name("password"));
        psw.clear();
        psw.sendKeys("nikola123");
        WebElement dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.cssSelector("input[type='submit']")));
        dugme.click();
        
        //driver.manage().timeouts().implicitlyWait(7, TimeUnit.SECONDS);
        Thread.sleep(1000);
        
        //link for meetings
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//html/body/div/ul/li[3]/a/i")));
        dugme.click();
        
        
        String poruka = driver.findElement(By.xpath("//html/body/section/a")).getText();
        Assert.assertEquals("Add new meeting", poruka);
        
        
        List<WebElement> elements = driver.findElements(By.xpath("//html/body/div/ul/li[5]/a"));
        
        Assert.assertEquals(true, elements.isEmpty());
        
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"log_out\"]")));
        dugme.click();
    }
	
	@Test
    public void testLoginEmployee() throws Exception {
        
        WebDriverWait cekaj = new WebDriverWait(driver, Duration.ofSeconds(10));
        
        WebElement user = cekaj.until(ExpectedConditions.elementToBeClickable(By.name("email")));
        
        user.clear();
        user.sendKeys("boris@gmail.com");
        WebElement psw = driver.findElement(By.name("password"));
        psw.clear();
        psw.sendKeys("boris123");
        WebElement dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.cssSelector("input[type='submit']")));
        dugme.click();
        
        //driver.manage().timeouts().implicitlyWait(7, TimeUnit.SECONDS);
        Thread.sleep(1000);
        
        //link for meetings
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//html/body/div/ul/li[3]/a/i")));
        dugme.click();
        
        
        List<WebElement> elements = driver.findElements(By.xpath("//html/body/div/ul/li[5]/a"));
        Assert.assertEquals(true, elements.isEmpty());
        
        dugme = cekaj.until(ExpectedConditions.elementToBeClickable(By.xpath("//*[@id=\"log_out\"]")));
        dugme.click();
    }
	
	
	
	@AfterTest
    public void posle(){
        if (driver != null){
            driver.quit();
        }
    }
	
}
