using System;
using OpenQA.Selenium;
using OpenQA.Selenium.Chrome;

namespace Almostengr.RhtServicesTest
{
    public abstract class BaseTest
    {
        public IWebDriver StartBrowser()
        {
            IWebDriver driver = null;
            ChromeOptions options = new ChromeOptions();

#if RELEASE
            options.AddArgument("--headless");
#endif

            driver = new ChromeDriver(options);
            driver.Manage().Timeouts().ImplicitWait = TimeSpan.FromSeconds(15);
            driver.Manage().Window.Maximize();

#if RELEASE
            driver.Navigate().GoToUrl("https://rhtservices.net");
#else
            driver.Navigate().GoToUrl("http://192.168.57.117:8082");
#endif

            return driver;
        }

        public void GoHome(IWebDriver driver)
        {
            driver.FindElement(By.LinkText("RHT Services LLC")).Click();
        }

        public void CloseBrowser(IWebDriver driver)
        {
            if (driver != null)
            {
                driver.Quit();
            }
        }
    }
}