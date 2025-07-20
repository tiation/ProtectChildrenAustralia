export default function Resources() {
  return (
    <div className="container mx-auto px-4 py-12">
      <div className="max-w-6xl mx-auto">
        <h1 className="text-5xl font-bold mb-8 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark bg-clip-text text-transparent text-center">
          Resources
        </h1>
        
        <p className="text-xl text-center mb-16 text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
          Access comprehensive resources designed to help protect children, support families, and strengthen communities across Australia.
        </p>
        
        {/* Emergency Resources */}
        <div className="mb-16 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-8 rounded-2xl">
          <h2 className="text-3xl font-bold mb-6 text-red-600 dark:text-red-400 text-center">Emergency Resources</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
              <h3 className="text-xl font-bold mb-2 text-red-600 dark:text-red-400">Emergency Services</h3>
              <p className="text-3xl font-bold mb-2">000</p>
              <p className="text-gray-600 dark:text-gray-300">For immediate danger or life-threatening situations</p>
            </div>
            <div className="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg">
              <h3 className="text-xl font-bold mb-2 text-red-600 dark:text-red-400">Child Protection Hotline</h3>
              <p className="text-3xl font-bold mb-2">13 14 78</p>
              <p className="text-gray-600 dark:text-gray-300">24/7 reporting of child abuse and neglect</p>
            </div>
          </div>
        </div>
        
        {/* Resource Categories */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
            <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Educational Materials</h3>
            <ul className="space-y-3 text-gray-600 dark:text-gray-300">
              <li>• Child safety guidelines for parents</li>
              <li>• Age-appropriate safety education</li>
              <li>• Recognizing signs of abuse</li>
              <li>• Building resilient children</li>
            </ul>
          </div>
          
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
            <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Support Services</h3>
            <ul className="space-y-3 text-gray-600 dark:text-gray-300">
              <li>• Counseling and therapy referrals</li>
              <li>• Family support programs</li>
              <li>• Crisis intervention services</li>
              <li>• Victim support resources</li>
            </ul>
          </div>
          
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
            <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Community Programs</h3>
            <ul className="space-y-3 text-gray-600 dark:text-gray-300">
              <li>• Neighborhood watch initiatives</li>
              <li>• School safety programs</li>
              <li>• Community education workshops</li>
              <li>• Volunteer opportunities</li>
            </ul>
          </div>
          
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
            <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Professional Resources</h3>
            <ul className="space-y-3 text-gray-600 dark:text-gray-300">
              <li>• Training for educators</li>
              <li>• Healthcare provider guidelines</li>
              <li>• Legal resources and information</li>
              <li>• Professional development courses</li>
            </ul>
          </div>
          
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
            <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Digital Safety</h3>
            <ul className="space-y-3 text-gray-600 dark:text-gray-300">
              <li>• Internet safety for children</li>
              <li>• Social media guidelines</li>
              <li>• Cyberbullying prevention</li>
              <li>• Parental controls guide</li>
            </ul>
          </div>
          
          <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
            <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Research & Reports</h3>
            <ul className="space-y-3 text-gray-600 dark:text-gray-300">
              <li>• Annual protection statistics</li>
              <li>• Research publications</li>
              <li>• Policy recommendations</li>
              <li>• Best practice studies</li>
            </ul>
          </div>
        </div>
        
        {/* Helpful Links */}
        <div className="bg-gradient-to-r from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 p-8 rounded-2xl">
          <h2 className="text-3xl font-bold mb-6 text-center">Important Organizations</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div className="bg-white dark:bg-gray-900 p-4 rounded-xl">
              <h4 className="font-bold mb-2">Kids Helpline</h4>
              <p className="text-sm text-gray-600 dark:text-gray-300">1800 55 1800 - Counseling for young people</p>
            </div>
            <div className="bg-white dark:bg-gray-900 p-4 rounded-xl">
              <h4 className="font-bold mb-2">Lifeline</h4>
              <p className="text-sm text-gray-600 dark:text-gray-300">13 11 14 - Crisis support and suicide prevention</p>
            </div>
            <div className="bg-white dark:bg-gray-900 p-4 rounded-xl">
              <h4 className="font-bold mb-2">Beyond Blue</h4>
              <p className="text-sm text-gray-600 dark:text-gray-300">1300 22 4636 - Mental health support</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}